"use strict";

/*
    Vanilla AutoComplete v0.1
    Copyright (c) 2019 Mauro Marssola
    GitHub: https://github.com/marssola/vanilla-calendar
    License: http://www.opensource.org/licenses/mit-license.php
*/
var VanillaCalendar = function () {
  function VanillaCalendar(options) {
    function addEvent(el, type, handler) {
      if (!el) return;
      if (el.attachEvent) el.attachEvent('on' + type, handler);else el.addEventListener(type, handler);
    }

    function removeEvent(el, type, handler) {
      if (!el) return;
      if (el.detachEvent) el.detachEvent('on' + type, handler);else el.removeEventListener(type, handler);
    }

    var opts = {
      selector: null,
      datesFilter: false,
      pastDates: true,
      availableWeekDays: [],
      availableDates: [],
      date: new Date(),
      todaysDate: new Date(),
      button_prev: null,
      button_next: null,
      month: null,
      month_label: null,
      onSelect: function onSelect(data, elem) {},
      months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      shortWeekday: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
    };

    for (var k in options) {
      if (opts.hasOwnProperty(k)) opts[k] = options[k];
    }

    var element = document.querySelector(opts.selector);
    if (!element) return;

    var getWeekDay = function getWeekDay(day) {
      return ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'][day];
    };

    var createDay = function createDay(date) {
      var newDayElem = document.createElement('div');
      var dateElem = document.createElement('span');
      dateElem.innerHTML = date.getDate();
      newDayElem.className = 'vanilla-calendar-date';
      newDayElem.setAttribute('data-calendar-date', date);
      var available_week_day = opts.availableWeekDays.filter(function (f) {
        return f.day === date.getDay() || f.day === getWeekDay(date.getDay());
      });
      var available_date = opts.availableDates.filter(function (f) {
        return f.date === date.getFullYear() + '-' + String(date.getMonth() + 1).padStart('2', 0) + '-' + String(date.getDate()).padStart('2', 0);
      });

      if (date.getDate() === 1) {
        newDayElem.style.marginLeft = date.getDay() * 14.28 + '%';
      }

      if (opts.date.getTime() <= opts.todaysDate.getTime() - 1 && !opts.pastDates) {
        newDayElem.classList.add('vanilla-calendar-date--disabled');
      } else {
        if (opts.datesFilter) {
          if (available_week_day.length) {
            newDayElem.classList.add('vanilla-calendar-date--active');
            newDayElem.setAttribute('data-calendar-data', JSON.stringify(available_week_day[0]));
            newDayElem.setAttribute('data-calendar-status', 'active');
          } else if (available_date.length) {
            newDayElem.classList.add('vanilla-calendar-date--active');
            newDayElem.setAttribute('data-calendar-data', JSON.stringify(available_date[0]));
            newDayElem.setAttribute('data-calendar-status', 'active');
          } else {
            newDayElem.classList.add('vanilla-calendar-date--disabled');
          }
        } else {
          newDayElem.classList.add('vanilla-calendar-date--active');
          newDayElem.setAttribute('data-calendar-status', 'active');
        }
      }

      if (date.toString() === opts.todaysDate.toString()) {
        newDayElem.classList.add('vanilla-calendar-date--today');
      }

      newDayElem.appendChild(dateElem);
      opts.month.appendChild(newDayElem);
    };

    var removeActiveClass = function removeActiveClass() {
      document.querySelectorAll('.vanilla-calendar-date--selected').forEach(function (s) {
        s.classList.remove('vanilla-calendar-date--selected');
      });
    };

    var selectDate = function selectDate() {
      var activeDates = element.querySelectorAll('[data-calendar-status=active]');
      console.log(activeDates);
      activeDates.forEach(function (date) {
        date.addEventListener('click', function () {
          removeActiveClass();
          var datas = this.dataset;
          var data = {};
          if (datas.calendarDate) data.date = datas.calendarDate;
          if (datas.calendarData) data.data = JSON.parse(datas.calendarData);
          opts.onSelect(data, this);
          this.classList.add('vanilla-calendar-date--selected');
        });
      });
    };

    var createMonth = function createMonth() {
      clearCalendar();
      var currentMonth = opts.date.getMonth();

      while (opts.date.getMonth() === currentMonth) {
        createDay(opts.date);
        opts.date.setDate(opts.date.getDate() + 1);
      }

      opts.date.setDate(1);
      opts.date.setMonth(opts.date.getMonth() - 1);
      opts.month_label.innerHTML = opts.months[opts.date.getMonth()] + ' ' + opts.date.getFullYear();
      selectDate();
    };

    var monthPrev = function monthPrev() {
      opts.date.setMonth(opts.date.getMonth() - 1);
      createMonth();
    };

    var monthNext = function monthNext() {
      opts.date.setMonth(opts.date.getMonth() + 1);
      createMonth();
    };

    var clearCalendar = function clearCalendar() {
      opts.month.innerHTML = '';
    };

    var createCalendar = function createCalendar() {
      document.querySelector(opts.selector).innerHTML = "\n            <div class=\"vanilla-calendar-header\">\n                <button type=\"button\" class=\"vanilla-calendar-btn\" data-calendar-toggle=\"previous\"><svg height=\"24\" version=\"1.1\" viewbox=\"0 0 24 24\" width=\"24\" xmlns=\"http://www.w3.org/2000/svg\"><path d=\"M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z\"></path></svg></button>\n                <div class=\"vanilla-calendar-header__label\" data-calendar-label=\"month\"></div>\n                <button type=\"button\" class=\"vanilla-calendar-btn\" data-calendar-toggle=\"next\"><svg height=\"24\" version=\"1.1\" viewbox=\"0 0 24 24\" width=\"24\" xmlns=\"http://www.w3.org/2000/svg\"><path d=\"M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z\"></path></svg></button>\n            </div>\n            <div class=\"vanilla-calendar-week\"></div>\n            <div class=\"vanilla-calendar-body\" data-calendar-area=\"month\"></div>\n            ";
    };

    var setWeekDayHeader = function setWeekDayHeader() {
      document.querySelector("".concat(opts.selector, " .vanilla-calendar-week")).innerHTML = "\n                <span>".concat(opts.shortWeekday[0], "</span>\n                <span>").concat(opts.shortWeekday[1], "</span>\n                <span>").concat(opts.shortWeekday[2], "</span>\n                <span>").concat(opts.shortWeekday[3], "</span>\n                <span>").concat(opts.shortWeekday[4], "</span>\n                <span>").concat(opts.shortWeekday[5], "</span>\n                <span>").concat(opts.shortWeekday[6], "</span>\n            ");
    };

    this.init = function () {
      createCalendar();
      opts.button_prev = document.querySelector(opts.selector + ' [data-calendar-toggle=previous]');
      opts.button_next = document.querySelector(opts.selector + ' [data-calendar-toggle=next]');
      opts.month = document.querySelector(opts.selector + ' [data-calendar-area=month]');
      opts.month_label = document.querySelector(opts.selector + ' [data-calendar-label=month]');
      opts.date.setDate(1);
      createMonth();
      setWeekDayHeader();
      addEvent(opts.button_prev, 'click', monthPrev);
      addEvent(opts.button_next, 'click', monthNext);
    };

    this.destroy = function () {
      removeEvent(opts.button_prev, 'click', monthPrev);
      removeEvent(opts.button_next, 'click', monthNext);
      clearCalendar();
      document.querySelector(opts.selector).innerHTML = '';
    };

    this.reset = function () {
      this.destroy();
      this.init();
    };

    this.set = function (options) {
      for (var _k in options) {
        if (opts.hasOwnProperty(_k)) opts[_k] = options[_k];
      }

      createMonth(); //             this.reset()
    };

    this.init();
  }

  return VanillaCalendar;
}();

window.VanillaCalendar = VanillaCalendar;