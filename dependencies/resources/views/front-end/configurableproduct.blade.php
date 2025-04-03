@extends('layouts.front-end')
@section('css')
<link rel="stylesheet" href="{{asset('/frontend-asset/css/jquery.steps.css')}}">

<link rel="stylesheet" href="{{asset('/frontend-asset/css/procompare.css')}}">
{{--
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
	integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
<style type="text/css">
	#configurable-t-0::after {
		content: "\f2fb";
		font-family: 'Material-Design-Iconic-Font';
		float: right;
		font-size: 24px;
		color: #444444;
		margin-top: -20px;

	}

	.current #configurable-t-0::after {
		color: #0087DC;
	}

	#configurable-t-1::after {
		content: "\f2fb";
		font-family: 'Material-Design-Iconic-Font';
		float: right;
		font-size: 24px;
		color: #444444;
		margin-top: -20px;

	}

	.current #configurable-t-1::after {
		color: #0087DC;
	}

	#configurable-t-2::after {
		content: "\f2fb";
		font-family: 'Material-Design-Iconic-Font';
		float: right;
		font-size: 24px;
		color: #444444;
		margin-top: -20px;

	}

	.current #configurable-t-2::after {
		color: #0087DC;
	}

	.resetenqu {
		display: block !important;
		padding: 0 !important;
		margin: 0 !important;
		border: none !important;
	}

	.lay-out-loader {
		position: fixed;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		z-index: 1200;
		height: 100vh;
		background: #fff;
		opacity: 0.7;
	}

	.loader {
		display: -webkit-box;
		display: flex;
		font-size: 2em;
		z-index: 1201;
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
	}

	.loader .dots {
		display: -webkit-box;
		display: flex;
		position: relative;
		top: 20px;
		left: -10px;
		width: 100px;
		-webkit-animation: dots 4s ease infinite 1s;
		animation: dots 4s ease infinite 1s;
	}

	.loader .dots div {
		position: relative;
		width: 10px;
		height: 10px;
		margin-right: 10px;
		border-radius: 100%;
		background-color: black;
	}

	.loader .dots div:nth-child(1) {
		width: 0px;
		height: 0px;
		margin: 5px;
		margin-right: 15px;
		-webkit-animation: show-dot 4s ease-out infinite 1s;
		animation: show-dot 4s ease-out infinite 1s;
	}

	.loader .dots div:nth-child(4) {
		background-color: transparent;
		-webkit-animation: dot-fall-left 4s linear infinite 1s;
		animation: dot-fall-left 4s linear infinite 1s;
	}

	.loader .dots div:nth-child(4):before {
		position: absolute;
		width: 10px;
		height: 10px;
		margin-right: 10px;
		border-radius: 100%;
		background-color: black;
		content: '';
		-webkit-animation: dot-fall-top 4s cubic-bezier(0.46, 0.02, 0.94, 0.54) infinite 1s;
		animation: dot-fall-top 4s cubic-bezier(0.46, 0.02, 0.94, 0.54) infinite 1s;
	}

	@-webkit-keyframes dots {
		0% {
			left: -10px;
		}

		20%,
		100% {
			left: 10px;
		}
	}

	@keyframes dots {
		0% {
			left: -10px;
		}

		20%,
		100% {
			left: 10px;
		}
	}

	@-webkit-keyframes show-dot {

		0%,
		20% {
			width: 0px;
			height: 0px;
			margin: 5px;
			margin-right: 15px;
		}

		30%,
		100% {
			width: 10px;
			height: 10px;
			margin: 0px;
			margin-right: 10px;
		}
	}

	@keyframes show-dot {

		0%,
		20% {
			width: 0px;
			height: 0px;
			margin: 5px;
			margin-right: 15px;
		}

		30%,
		100% {
			width: 10px;
			height: 10px;
			margin: 0px;
			margin-right: 10px;
		}
	}

	@-webkit-keyframes dot-fall-left {

		0%,
		5% {
			left: 0px;
		}

		100% {
			left: 200px;
		}
	}

	@keyframes dot-fall-left {

		0%,
		5% {
			left: 0px;
		}

		100% {
			left: 200px;
		}
	}

	@-webkit-keyframes dot-fall-top {

		0%,
		5% {
			top: 0px;
		}

		30%,
		100% {
			top: 50vh;
		}
	}

	@keyframes dot-fall-top {

		0%,
		5% {
			top: 0px;
		}

		30%,
		100% {
			top: 50vh;
		}
	}

	@media (min-width: 992px) {
		.border-t-2px {
			border-top: none;
		}
	}

	.d-p-cal {
		display: table-cell !important;
	}

	.btn-enquiry:disabled {
		color: #000;
		background-color: #e7e9ed !important;
	}


	/* #PDFconfigurable{
		display: none;
	} */
</style>
@endsection
@section('meta')
<title>{{isset($metatag[0]->title)? $metatag[0]->title :''}}</title>
<meta name="description" content="{{isset($metatag[0]->description)? $metatag[0]->description :''}}">
<link rel="canonical" href="{{url()->current()}}" />
<?php
  $lang_seo = App::getLocale();
  if($lang_seo == 'cn'){
    $lang_seo = 'zh-Hans-CN';
  }else if($lang_seo == 'tw'){
    $lang_seo = 'zh-Hans-TW';
  }
?>
<link rel="alternate" href="{{url()->current()}}" hreflang="{{$lang_seo}}" />
@endsection
@section('container')
<div class="padding-top-content">
</div>
<div class="products-index-nav visible-up-922">
	<div class="bg-bredcrumb">
		<div class="container">
			<nav aria-label="breadcrumb" id="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item text-breadcrumb-home"><a
							href="{{route('index','home')}}">{{$staticContent['Home']}}</a></li>
					<li class="breadcrumb-item active text-breadcrumb-home dropdown" aria-current="page"><a href="#"
							data-toggle="dropdown" id="tools-dropdown"> {{$staticContent['Tools']}}</a>
						<ul class="dropdown-menu">
							<li><a href="#" id="tools-dropdown" class="text-bold">{{$staticContent['Tools']}}</a></li>
							<hr>
							<li><a href="{{route('productFinder')}}">{{$staticContent['Product_Selector']}}</a></li>
							<li><a
									href="{{route('configurableproduct')}}">{{$staticContent['configurable_power_selector']}}</a>
							</li>
							<li><a href="{{route('productCoparison')}}">{{$staticContent['product_comparison']}}</a>
							</li>
						</ul>
					</li>
					<li class="breadcrumb-item active text-breadcrumb" aria-current="page"><a
							href="#">{{$staticContent['configurable_power_selector']}}</a></li>
				</ol>
			</nav>
		</div>
	</div>
</div>
<div class="padding-top-content-breadcrumb visible-up-922"></div>
<div class="box-config mb-5">
	<div class="container">
		<h1 class="text-title-delta visible-up-922">{{$staticContent['configurable_power_selector']}}</h1>
		<h3 class="text-title-delta invisible-up-922">{{$staticContent['configurable_power_selector']}}</h3>
		<h4 class="d-flex justify-content-center mb-2 text-center" style="margin-top: -2rem">{{isset($metatag[0]->h1)? $metatag[0]->h1 :''}}</h4>
		<div id="configurable">
			<h3><b class="font-size-24 ">01</b><br>{{$staticContent['Select_Model']}}</h3>
			<section>
				<div class="heading-for-mobile text-center invisible-up-922 mb-4">
					<img class="img-fluid mb-2 img-step" src="{{asset('/frontend-asset/image/icon/Step1.svg')}}">
					<h4 class="text-color-delta">{{$staticContent['Select_Model']}}</h4>
				</div>
				<h5 class="text-center visible-up-922">{{$staticContent['Select_Model']}}</h5>
				<div class="row justify-content-center">
					<div class="col-12">
						<div class="row justify-content-center">

							<div class="form-group col-12 col-lg-4">

								<select name="" class="form-control" onchange="loadData();" id="model"></select>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-12" id="img-fistdata">
					</div>
					<div class="col-lg-4 col-md-12">
						<div class="content">
							<p class="mb-1"><b class="text-sixteen-delta">{{$staticContent['Highlights_Features']}}</b>
							</p>
							<div class="text-info">
							</div>
							{{-- <p class="my-1"><b>LOBORTIS CONSEQUAT LIGULA</b></p> --}}
							<p class="m-0"><span
									class="text-sixteen-delta c_delta"><b>{{$staticContent['Unit_Weight']}}</b></span>
							</p>
							<p class="c_delta_weight text-detail-describe m-0"></p>
							<br>
							<p class="m-0"><span class="text-sixteen-delta c_delta"><b>{{$staticContent['Dimensions']}}
										({{$staticContent['key_l']}} x {{$staticContent['key_w']}} x
										{{$staticContent['key_h']}})</b></span></p>
							<p class="c_delta_mm text-detail-describe m-0"></p>
							<p class="c_delta_inc text-detail-describe m-0"></p>

						</div>

					</div>
					<div class="col-12">
						<p class="text-center mt-5">
							*{{$staticContent['If_you_need_the_frame_or_module_only']}}
						</p>
					</div>
				</div>
			</section>
			<h3><b class="font-size-24 ">02</b><br>{{$staticContent['Select_Output(s)']}}</h3>
			<section>
				<div class="heading-for-mobile text-center invisible-up-922">
					<img class="img-fluid mb-2 img-step" src="{{asset('/frontend-asset/image/icon/Step2.svg')}}">
					<h4 class="text-color-delta">{{$staticContent['Select_Output(s)']}}</h4>
				</div>
				<div class="row add-space-mobile reverse-on-mobile ">

					<div class="col-lg-12 col-md-12 order-lg-2">
						<div class="row  mt-lg-5">
							<div class="col-lg-6">
								<h5 class="visible-up-922">{{$staticContent['Select_Output(s)']}}</h5>
								<div class="slot ">
								</div>
								<button class="btn btn-subscribe btn-xs mt-2 ml-mobile-6px" id="addmore"
									onclick="addSlotOutput()">
									<i class="zmdi zmdi-plus"></i>
									{{$staticContent['Add_More_Output']}}
								</button>
							</div>
							<div class="col-lg-6">
								<div class="row mt-3 pt-2 add-space-mobile border-t-2px">
									<div class="col-4 column-total">
										<label for="output_total">
											<h5>{{$staticContent['Total_No_of_Output']}}</h5>
										</label>
										<input type="text" id="output_total" name="output_total" class="form-control"
											value="1" disabled="disabled">
									</div>
									<div class="col-4 offset-4 column-total">
										<label for="power">
											<h5>{{$staticContent['Total_Output_Power']}}</h5>
										</label>
										<input type="text" id="power" name="power" class="form-control" value=""
											disabled="disabled" placeholder="Total Power">
									</div>
								</div>

								<div class="row  add-space-mobile">
									<div class="col-lg-6 col-md-12 mt-3">
										<label for="">
											<h5>{{$staticContent['Option']}}
												<span class="wrp-icons">
													<img id="option_ti" class="align-baseline"
														src="{{asset('frontend-asset/image/tooltip.svg')}}"
														data-toggle="tooltip" data-placement="top"
														title="{{$staticContent['Inlet_Type_description']}}">
												</span>
											</h5>
										</label>
										<select class="form-control" id="terminal"
											onchange="getToSummary();getToTerimal();">
											<option value="1">{{$staticContent['t_for_american_terminal']}}</option>
											<option value="2">{{$staticContent['e_for_european_terminal']}}</option>
											<option value="3">{{$staticContent['c_for_c14']}}</option>
										</select>
									</div>
									<div class="col-lg-6 col-md-12 mt-3">
										<label for="">
											<h5>{{$staticContent['Communication']}}
												<span class="wrp-icons">
													<img class="align-baseline"
														src="{{asset('frontend-asset/image/tooltip.svg')}}"
														data-toggle="tooltip" data-placement="top"
														title="{{$staticContent['Communication_description']}}">
												</span>
											</h5>
										</label>
										<select class="form-control" id="bus" onchange="getToSummary()">
											{{-- <option selected="selected" value="0">Default PMBus</option>
											<option value="1">RS232 adapter</option>
											<option value="2">USB adapter</option>
											<option value="3">RS485 adapter</option> --}}
										</select>
									</div>

								</div>
								<div class="row mt-3 add-space-mobile">
									<div class="col-12">
										<label for="">
											<h5>{{$staticContent['Control_Code']}}
												<span class="wrp-icons">
													<img class="align-baseline"
														src="{{asset('frontend-asset/image/tooltip.svg')}}"
														data-toggle="tooltip" data-placement="top"
														title="{{$staticContent['Control_Code_description']}}">
												</span>
											</h5>
										</label>
										<select class="form-control" id="logic" onchange="getToSummary()">
											<option selected="selected" value="0">
												{{$staticContent['Normal_Logic_&_Normal_Fan_Direction']}}
											</option>
											<option value="1">
												{{$staticContent['Reversed_Logic_&_Normal_Fan_Direction']}}</option>
											<option value="2">{{$staticContent['Normal_Logic_&_Reversed_Fan_Direction']}}
											</option>
											<option value="3">
												{{$staticContent['Reversed_Logic_&_Reversed_Fan_Direction']}}</option>
										</select>
									</div>
								</div>
							</div>
						</div>



					</div>
					<div class="col-lg-12 col-md-12 order-lg-1" style="padding-left:24px;">
						<h4 class=" text-center text-dark visible-up-922">{{$staticContent['Module_Preview']}}</h4>
						<div id="bg-slot">
							<div class="preview d-flex" id="port">
							</div>
						</div>
						<div id="certificate" class="text-center">
						</div>
					</div>
				</div>
			</section>
			<h3><b class="font-size-24 ">03</b><br>{{$staticContent['Select_Parallel']}}</h3>
			<section>
				<div class="heading-for-mobile text-center invisible-up-922">
					<img class="img-fluid mb-2 img-step" src="{{asset('/frontend-asset/image/icon/Step3.svg')}}">
					<h4 class="text-color-delta">{{$staticContent['Select_Parallel_Connection(s)']}}<span
							class="wrp-icons">
							<img class="img-tooltip" src="{{asset('frontend-asset/image/tooltip.svg')}}"
								data-toggle="tooltip" data-placement="top"
								title="{{$staticContent['Control_Code_description']}}">
						</span></h4>
				</div>
				<div class="row justify-content-center add-space-mobile p-0">
					<div class="col-lg-8 col-md-12">
						<h5 class="text-center visible-up-922">{{$staticContent['Select_Parallel_Connection(s)']}}
							<span class="wrp-icons">
								<img src="{{asset('frontend-asset/image/tooltip.svg')}}" data-toggle="tooltip"
									data-placement="top"
									title="{{$staticContent['Control_Code_description']}}">
							</span>
						</h5>
						<div id="data_tableslot"></div>

						{{-- <table class="w-100 parallel">
							<thead>
								<tr class="header-td">
									<td></td>
									<td>Code</td>
									<td>{{$staticContent['Slot']}}1</td>
									<td>{{$staticContent['Slot']}}2</td>
									<td>{{$staticContent['Slot']}}3</td>
									<td>{{$staticContent['Slot']}}4</td>
									<td>{{$staticContent['Slot']}}5</td>
									<td>{{$staticContent['Slot']}}6</td>
								</tr>
							</thead>
							<tbody>
								<tr id="parallel0">
									<td class="d-flex"><input type="radio" value="0" name="parallel"
											checked="checked"><label></label></td>
									<td>0</td>
									<td colspan="6"></td>
								</tr>
								<tr id="parallelA">
									<td class="input d-flex"><input type="radio" value="A"
											name="parallel"><label></label></td>
									<td>A</td>
									<td colspan="2" class="line">
										<div class="bg-box h-25 w-75 mx-auto rounded"></div>
									</td>
									<td colspan="4"></td>
								</tr>
								<tr id="parallelB">
									<td class="input d-flex"><input type="radio" value="B"
											name="parallel"><label></label></td>
									<td>B</td>
									<td colspan="1"></td>
									<td colspan="2" class="line">
										<div class="bg-box h-25 w-75 mx-auto rounded"></div>
									</td>
									<td colspan="3"></td>
								</tr>
								<tr id="parallelC">
									<td class="input d-flex"><input type="radio" value="C"
											name="parallel"><label></label></td>
									<td>C</td>
									<td colspan="2"></td>
									<td colspan="2" class="line">
										<div class="bg-box h-25 w-75 mx-auto rounded"></div>
									</td>
									<td colspan="2"></td>
								</tr>
								<tr id="parallelD">
									<td class="input d-flex"><input type="radio" value="D"
											name="parallel"><label></label></td>
									<td>D</td>
									<td colspan="3"></td>
									<td colspan="2" class="line">
										<div class="bg-box h-25 w-75 mx-auto rounded"></div>
									</td>
									<td colspan="1"></td>
								</tr>
								<tr id="parallelE">
									<td class="input d-flex"><input type="radio" value="E"
											name="parallel"><label></label></td>
									<td>E</td>
									<td colspan="4"></td>
									<td colspan="2" class="line">
										<div class="bg-box h-25 w-75 mx-auto rounded"></div>
									</td>
								</tr>
								<tr id="parallelF">
									<td class="input d-flex"><input type="radio" value="F"
											name="parallel"><label></label></td>
									<td>F</td>
									<td colspan="2" class="line">
										<div class="bg-box h-25 w-75 mx-auto rounded"></div>
									</td>
									<td colspan="2" class="line">
										<div class="bg-box h-25 w-75 mx-auto rounded"></div>
									</td>
									<td colspan="2"></td>
								</tr>
								<tr id="parallelG">
									<td class="input d-flex"><input type="radio" value="G"
											name="parallel"><label></label></td>
									<td>G</td>
									<td colspan="2" class="line">
										<div class="bg-box h-25 w-75 mx-auto rounded"></div>
									</td>
									<td colspan="1"></td>
									<td colspan="2" class="line">
										<div class="bg-box h-25 w-75 mx-auto rounded"></div>
									</td>
									<td colspan="1"></td>
								</tr>
								<tr id="parallelH">
									<td class="input d-flex"><input type="radio" value="H"
											name="parallel"><label></label></td>
									<td>H</td>
									<td colspan="2" class="line">
										<div class="bg-box h-25 w-75 mx-auto rounded"></div>
									</td>
									<td colspan="2"></td>
									<td colspan="2" class="line">
										<div class="bg-box h-25 w-75 mx-auto rounded"></div>
									</td>
								</tr>
								<tr id="parallelI">
									<td class="input d-flex"><input type="radio" value="I"
											name="parallel"><label></label></td>
									<td>I</td>
									<td colspan="2" class="line">
										<div class="bg-box h-25 w-75 mx-auto rounded"></div>
									</td>
									<td colspan="2" class="line">
										<div class="bg-box h-25 w-75 mx-auto rounded"></div>
									</td>
									<td colspan="2" class="line">
										<div class="bg-box h-25 w-75 mx-auto rounded"></div>
									</td>
								</tr>
								<tr id="parallelJ">
									<td class="input d-flex"><input type="radio" value="J"
											name="parallel"><label></label></td>
									<td>J</td>
									<td colspan="1"></td>
									<td colspan="2" class="line">
										<div class="bg-box h-25 w-75 mx-auto rounded"></div>
									</td>
									<td colspan="2" class="line">
										<div class="bg-box h-25 w-75 mx-auto rounded"></div>
									</td>
									<td colspan="1"></td>
								</tr>
								<tr id="parallelK">
									<td class="input d-flex"><input type="radio" value="K"
											name="parallel"><label></label></td>
									<td>K</td>
									<td colspan="1"></td>
									<td colspan="2" class="line">
										<div class="bg-box h-25 w-75 mx-auto rounded"></div>
									</td>
									<td colspan="1"></td>
									<td colspan="2" class="line">
										<div class="bg-box h-25 w-75 mx-auto rounded"></div>
									</td>
								</tr>
								<tr id="parallelL">
									<td class="input d-flex"><input type="radio" value="L"
											name="parallel"><label></label></td>
									<td>L</td>
									<td colspan="2"></td>
									<td colspan="2" class="line">
										<div class="bg-box h-25 w-75 mx-auto rounded"></div>
									</td>
									<td colspan="2" class="line">
										<div class="bg-box h-25 w-75 mx-auto rounded"></div>
									</td>
								</tr>
							</tbody>
						</table> --}}
					</div>
				</div>
			</section>
			<h3><b class="font-size-24 t">04</b><br>{{$staticContent['Summary']}}</h3>
			<section class="summary-body config-conten" id="sumbb">
				<div class="heading-for-mobile text-center invisible-up-922">
					<img class="img-fluid mb-2 img-step" src="{{asset('/frontend-asset/image/icon/Step4.svg')}}">
					<h4 class="text-color-delta">{{$staticContent['Summary']}}</h4>
				</div>
				<div id="configurable-summary">
					<div class="d-flex flex-wrap border-2px-unmobile" id="savethis">
						{{-- <div class="col-12"> --}}
							<div class="summary-subbody">
								<!-- <h5 class="text-color-delta">{{$staticContent['Factory_Model_Name']}} :</h5>
							<h3 class="factory text-normal"></h3> -->

								<h5 class="text-color-delta">{{$staticContent['Customer_Model_Name']}} :</h5>
								<h3 class="customer text-normal"></h3>
							</div>
							<div class="summary-subbody d-flex flex-wrap justify-content-start">
								<div class="col-lg-3 col-md-12 img-summary-add"></div>
								<div class="col-lg-9 col-md-12" id="text-summary">
									<div class="col-lg-4 col-md-12">
										<p class="mb-1"><b
												class="text-sixteen-delta">{{$staticContent['Highlights_Features']}}</b>
										</p>
										<div class="text-info"></div>
										<p class="m-0"><span
												class="text-sixteen-delta c_delta"><b>{{$staticContent['Unit_Weight']}}</b></span>
										</p>
										<p class="c_delta_weight text-detail-describe m-0"></p>
										<br>
										<p class="m-0"><span
												class="text-sixteen-delta c_delta"><b>{{$staticContent['Dimensions']}}
													(L x W x
													H)</b></span></p>
										<p class="c_delta_mm text-detail-describe m-0"></p>
										<p class="c_delta_inc text-detail-describe m-0"></p>
									</div>
								</div>
							</div>
							<div class="summary-subbody w-100">
								<h3>{{$staticContent['General_Description']}}</h3>
								<div class="row add-space-mobile" style="">
									<div class="col-lg-6 col-md-12">
										<div class="describe-list">
											<p class="text-sixteen-delta">{{$staticContent['Total_Output_Power']}} :</p>
											<p class="text-detail-describe" id="sumpower">-</p>
										</div>
										<div class="describe-list">
											<p class="text-sixteen-delta">
												{{$staticContent['Configuration_Modular_Parts']}}:</p>
											<p class="text-detail-describe" id="customer"></p>
											<p class="text-detail-describe" id="model-fac"></p>
											<p class="text-detail-describe" style="display:none;" id="factory"></p>

										</div>
										<div class="describe-list">
											<p class="text-sixteen-delta">{{$staticContent['of_slots']}} :</p>
											<p class="text-detail-describe" id="numoutput"></p>
										</div>
										<div class="describe-list">
											<p class="text-sixteen-delta">{{$staticContent['Inlet_Type']}} :</p>
											<p class="text-detail-describe" id="inlet"></p>
										</div>
										<div class="describe-list">
											<p class="text-sixteen-delta">{{$staticContent['Communication']}} :</p>
											<p class="text-detail-describe" id="commu"></p>
										</div>
										<div class="describe-list">
											<p class="text-sixteen-delta">{{$staticContent['Control_Code']}}:</p>
											<p class="text-detail-describe" id="control-code"></p>
										</div>
									</div>
									<div class="col-lg-6 col-md-12 column-model">
										<div class="describe-list">
											<p class="text-sixteen-delta">{{$staticContent['Module(s)']}} :</p>
											<div id="list-slot" class="text-detail-describe"></div>
										</div>
									</div>
									<div class="col-lg-12 col-md-12 column-model">

										<div id="bg-slot02">
											<div class="preview d-flex " id="port02">
											</div>
										</div>
										<div class="w-100">
											<div class="" style="margin-top:24px;">
												<p class="text-sixteen-delta">{{$staticContent['Parallel_Detail']}}</p>
												<div id="data_table2_con"></div>
												{{-- <table class="w-100 parallel" style="margin-top:12px;">
													<thead>
														<tr class="header-td">
															<td></td>
															<td>Code</td>
															<td>{{$staticContent['Slot']}}1</td>
															<td>{{$staticContent['Slot']}}2</td>
															<td>{{$staticContent['Slot']}}3</td>
															<td>{{$staticContent['Slot']}}4</td>
															<td>{{$staticContent['Slot']}}5</td>
															<td>{{$staticContent['Slot']}}6</td>
														</tr>
													</thead>
													<tbody>
														<tr id="parallel0">
															<td><input type="radio" value="0" name="parallel-2"
																	checked="checked"><label></label></td>
															<td>0</td>
															<td colspan="6"></td>
														</tr>
														<tr id="parallelA">
															<td class="input"><input type="radio" value="A"
																	name="parallel-2"><label></label></td>
															<td>A</td>
															<td colspan="2" class="line">
																<div class="bg-box h-25 w-75 mx-auto rounded"></div>
															</td>
															<td colspan="4"></td>
														</tr>
														<tr id="parallelB">
															<td class="input"><input type="radio" value="B"
																	name="parallel-2"><label></label></td>
															<td>B</td>
															<td colspan="1"></td>
															<td colspan="2" class="line">
																<div class="bg-box h-25 w-75 mx-auto rounded"></div>
															</td>
															<td colspan="3"></td>
														</tr>
														<tr id="parallelC">
															<td class="input"><input type="radio" value="C"
																	name="parallel-2"><label></label></td>
															<td>C</td>
															<td colspan="2"></td>
															<td colspan="2" class="line">
																<div class="bg-box h-25 w-75 mx-auto rounded"></div>
															</td>
															<td colspan="2"></td>
														</tr>
														<tr id="parallelD">
															<td class="input"><input type="radio" value="D"
																	name="parallel-2"><label></label></td>
															<td>D</td>
															<td colspan="3"></td>
															<td colspan="2" class="line">
																<div class="bg-box h-25 w-75 mx-auto rounded"></div>
															</td>
															<td colspan="1"></td>
														</tr>
														<tr id="parallelE">
															<td class="input"><input type="radio" value="E"
																	name="parallel-2"><label></label></td>
															<td>E</td>
															<td colspan="4"></td>
															<td colspan="2" class="line">
																<div class="bg-box h-25 w-75 mx-auto rounded"></div>
															</td>
														</tr>
														<tr id="parallelF">
															<td class="input"><input type="radio" value="F"
																	name="parallel-2"><label></label></td>
															<td>F</td>
															<td colspan="2" class="line">
																<div class="bg-box h-25 w-75 mx-auto rounded"></div>
															</td>
															<td colspan="2" class="line">
																<div class="bg-box h-25 w-75 mx-auto rounded"></div>
															</td>
															<td colspan="2"></td>
														</tr>
														<tr id="parallelG">
															<td class="input"><input type="radio" value="G"
																	name="parallel-2"><label></label></td>
															<td>G</td>
															<td colspan="2" class="line">
																<div class="bg-box h-25 w-75 mx-auto rounded"></div>
															</td>
															<td colspan="1"></td>
															<td colspan="2" class="line">
																<div class="bg-box h-25 w-75 mx-auto rounded"></div>
															</td>
															<td colspan="1"></td>
														</tr>
														<tr id="parallelH">
															<td class="input"><input type="radio" value="H"
																	name="parallel-2"><label></label></td>
															<td>H</td>
															<td colspan="2" class="line">
																<div class="bg-box h-25 w-75 mx-auto rounded"></div>
															</td>
															<td colspan="2"></td>
															<td colspan="2" class="line">
																<div class="bg-box h-25 w-75 mx-auto rounded"></div>
															</td>
														</tr>
														<tr id="parallelI">
															<td class="input"><input type="radio" value="I"
																	name="parallel-2"><label></label></td>
															<td>I</td>
															<td colspan="2" class="line">
																<div class="bg-box h-25 w-75 mx-auto rounded"></div>
															</td>
															<td colspan="2" class="line">
																<div class="bg-box h-25 w-75 mx-auto rounded"></div>
															</td>
															<td colspan="2" class="line">
																<div class="bg-box h-25 w-75 mx-auto rounded"></div>
															</td>
														</tr>
														<tr id="parallelJ">
															<td class="input"><input type="radio" value="J"
																	name="parallel-2"><label></label></td>
															<td>J</td>
															<td colspan="1"></td>
															<td colspan="2" class="line">
																<div class="bg-box h-25 w-75 mx-auto rounded"></div>
															</td>
															<td colspan="2" class="line">
																<div class="bg-box h-25 w-75 mx-auto rounded"></div>
															</td>
															<td colspan="1"></td>
														</tr>
														<tr id="parallelK">
															<td class="input"><input type="radio" value="K"
																	name="parallel-2"><label></label></td>
															<td>K</td>
															<td colspan="1"></td>
															<td colspan="2" class="line">
																<div class="bg-box h-25 w-75 mx-auto rounded"></div>
															</td>
															<td colspan="1"></td>
															<td colspan="2" class="line">
																<div class="bg-box h-25 w-75 mx-auto rounded"></div>
															</td>
														</tr>
														<tr id="parallelL">
															<td class="input"><input type="radio" value="L"
																	name="parallel-2"><label></label></td>
															<td>L</td>
															<td colspan="2"></td>
															<td colspan="2" class="line">
																<div class="bg-box h-25 w-75 mx-auto rounded"></div>
															</td>
															<td colspan="2" class="line">
																<div class="bg-box h-25 w-75 mx-auto rounded"></div>
															</td>
														</tr>
													</tbody>
												</table> --}}

											</div>
										</div>
									</div>
								</div>
							</div>

							{{--
						</div> --}}
					</div>
				</div>
				<button id="savedataauto" onclick="addToiframe()" class="d-none">Save to pdf</button>


			</section>
		</div>
	</div>
</div>

<div class="modal fade bd-example-modal-xl" id="sentToPDF" tabindex="-1" role="dialog" aria-labelledby="sentToPDF"
	aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="text-delta" id="sentToPDF">Send PDF to me</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="submitSupport" name="configform" action="{{route('SubmitContact')}}"
				onsubmit="return checkConfigFilefrom()" method="POST">
				<div class="modal-body">

					{{csrf_field()}}
					<input type="hidden" name="config_id" id="con_id">
					<input type="hidden" name="enquireStatus" id="enquireStatus" value="3">
					<input type="hidden" id="subject" name="subject" value="Configurable Power PDF Download">
					<input type="hidden" name="type_name" id="type_name" value="Configurable Power">
					<input type="hidden" name="type_id" id="type_id" value="7">
					<input type="hidden" name="model_name" id="model_name">
					<div class="form-group row">
						<div class="col-lg-6 col-md-12 my-2">
							<label for="country" class="">
								<h6> Country <span style="color: red">*</span> :</h6>
							</label>
							<div class="">
								<select name="country" class="form-control" onchange="selectCountry();"
									id="countryemailId" required>
									<option value="0">{{$staticContent['Select']}} {{$staticContent['Country']}}
									</option>
									@foreach ($countryemails as $email)
									<option value="{{$email->country}}">{{$email->country}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-lg-6 col-md-12 my-2">
							<label for="city" class=" ">
								<h6>City / State </h6>
							</label>
							<div class="">
								<select name="state" class="form-control" id="stateId">
									<option value="" data-color="red">{{$staticContent['Select']}}
										{{$staticContent['City_State']}}
									</option>
								</select>
							</div>
						</div>

					</div>
					<div class="form-group w-100 my-2">
						<div class="col-12">
							<label for="input-email" class="">
								<h6>Email <span style="color: red">*</span> :</h6>
							</label>
							<div class="">
								<input type="email" name="email" id="input-email" aria-describedby="emailHelp"
									class="form-control" required>
							</div>
						</div>
					</div>
					<div class="col-12 my-2">
						<label for="name-sale" class=" ">
							<h6>Firstname, Lastname <span style="color: red">*</span> :</h6>
						</label>
						<div class="">
							<input type="text" name="name" pattern="[A-Za-zก-๏\s]+" title="" id="name-sale"
								class="form-control" required>
						</div>
					</div>
					<div class="col-12">
						<form action="?" method="POST">
							<div class="mt-4" id="recap_vertify"></div>
							<br>
						</form>
					</div>

					<input type="hidden" id="keyrecap" name="keyrecap" value="">

					<div class="col-12">
						<input class="inp-cbx" id="cx-sale-en" type="checkbox" style="display: none;" />
						<label class="cbx" for="cx-sale-en"><span>
								<svg width="12px" height="10px" viewbox="0 0 12 10">
									<polyline points="1.5 6 4.5 9 10.5 1"></polyline>
								</svg></span><span>Sales Enquiry</span></label>
					</div>

					<div id="sale-enquiry">
						<div class="col-12 my-2">
							<label for="company-sale" class=" ">
								<h6>Company <span style="color: red">*</span> :</h6>
							</label>
							<div class="">
								<input type="text" name="company" pattern="[A-Za-zก-๏\s]+" title="" id="company-sale"
									class="form-control">
							</div>
						</div>
						<div class="col-12 my-2">
							<label for="message-sale" class=" ">
								<h6>Message <span style="color: red">*</span> :</h6>
							</label>
							<div class="">
								<textarea name="message" id="message" class="form-control" rows="4"></textarea>
							</div>
						</div>
					</div>
					<div class="col-12">
						<input class="inp-cbx" value="0" name="checkData" onchange="checkdata();" id="checkdataSub"
							type="checkbox" style="display: none;" />
						<label class="cbx" for="checkdataSub"><span>
								<svg width="12px" height="10px" viewbox="0 0 12 10">
									<polyline points="1.5 6 4.5 9 10.5 1"></polyline>
								</svg></span><span>Sign up for newsletter</span></label>

						<div class="box-input-checkbox">
							<input class="inp-cbx" name="prichk" id="privacycheck" value="1"
								onclick="onacceptionPolicy()" type="checkbox" style="display: none;" />
							<label class="cbx" for="privacycheck"><span>
									<svg width="12px" height="10px" viewbox="0 0 12 10">
										<polyline points="1.5 6 4.5 9 10.5 1"></polyline>
									</svg></span><span style="padding-left:9px;">
									{{$staticContent['By_submitting_this_form']}} <a target="_blank"
										href="{{route('privacyPolicy')}}"
										class=" text-underline">{{$staticContent['Privacy_Policy']}}</a><text
										class="red">*</text></span> </label>
						</div>
					</div>
					<div class="red" id="error-massage">
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-subscribe">Send</button>
					</div>

				</div>
			</form>

		</div>
	</div>
</div>
<input type="hidden" id="stateSelectbth" value="0">
<iframe id="PDFconfigurable" frameborder="0" width="1280" height="0"></iframe>
<div class="lay-out-loader" id="loaderSavefile" style="display: none">
	<div class="loader">
		<div class="text">Loading</div>
		<div class="dots">
			<div></div>
			<div></div>
			<div></div>
			<div></div>
		</div>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{asset('/frontend-asset/js/jspdf.debug.js')}}"></script>
<script>
	$(document).ready(function() {
        msieversion();
       });
      function msieversion()
            {
                var ua = window.navigator.userAgent;
                var msie = ua.indexOf("MSIE");

                if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) // If Internet Explorer, return version number
                {
                  var script = document.createElement('script');
                    script.type = 'text/javascript';
                    script.src = '{{asset('/frontend-asset/js/html2canvasie.js')}}';

                    document.getElementsByTagName('head')[0].appendChild(script);

                }
                else  // If another browser, return 0
                {
                  var script = document.createElement('script');
                    script.type = 'text/javascript';
                    script.src = '{{asset('/frontend-asset/js/html2canvas.js')}}';

                    document.getElementsByTagName('head')[0].appendChild(script);

                }

                return false;
            }
</script>
<script type="text/javascript">
	var verifyCallback = function(response) {
	  // alert(response);
	  $('#keyrecap').val(response);
	};
	var onloadCallback = function() {
	  grecaptcha.render('recap_vertify', {
	//    'sitekey' : '6LdshPcUAAAAACIioRg3pa05GCUYQ9S0hVLv-4zv',
         'sitekey' : '6LeFKfYUAAAAAL-q5mHlmjUTPQ-LvlDjNtev9QhA',
								//'sitekey' : '6LcPwHQpAAAAAL5BjEcFskLuvXnrUP9aNeeCv_9R',
		'callback' : verifyCallback,
		'theme' : 'light'
	  });
	};
	$("#submitSupport").submit(function( event ) {
	//   if($('#keyrecap').val() == ''){
	// 	 alert('Please Vertify I am not a robot?');
	//   }else{
	// 	$('#submitSupport').submit();
	//   }
	  $('#submitSupport').submit();
	  event.preventDefault();
   });

       @if(Session::has('message_eror'))
        $(document).ready(function() {
             $("#downloadgui-modal-failures").modal();
          });
        @endif
		@if(Session::has('message_eror_notValid'))
        $(document).ready(function() {
             $("#Support_Frorm_required").modal();
          });
        @endif

</script>
<script src="{{asset('/frontend-asset/js/jquery.steps.min.js')}}"></script>
<script>
	@if(Session::has('message'))
        $(document).ready(function() {
             $("#sendConfigpdf").modal();
          });
        @endif

function checkdata(){
	if($('#checkdataSub').val() == 0){
		$('#checkdataSub').val(1);
	}else{
		$('#checkdataSub').val(0);
	}
}

function selectCountry(){
       var countryname = $('#countryemailId').val();
       $.ajax({
            url: "{{(route('searhstate'))}}",
            data: {
            'countryname': countryname,
           },
           type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {

                var options = '';

                for (var i = 0; i < data['results'].length; i++) {
                    options += '<option value="' + data['results'][i].name + '">' + data['results'][i].name + '</option>';
                }
                $("select#stateId").html(options);
            }

        });
   }
</script>
<script>
	$("#sale-enquiry").hide();
	$("#cx-sale-en").click(function(){
  	  $("#sale-enquiry").toggle();
		if($(this).prop("checked") == true){
                // alert("Checkbox is checked.");
				$('#name-sale').prop('required',true);
				$('#company-sale').prop('required',true);
				$('#message').prop('required',true);
				$('#enquireStatus').val(0);
				$('#subject').val(0);
            }
            else if($(this).prop("checked") == false){
                // alert("Checkbox is unchecked.");
				$('#name-sale').prop('required',false);
				$('#company-sale').prop('required',false);
				$('#message').prop('required',false);
				$('#enquireStatus').val(3);
				$('#subject').val('Configurable Power Selector PDF');
            }
	});
	$("#cx-sale-en").click(function(){

	});

	var model_name = <?=$model?>;
	function getLastNumber(str) {
    	var matches = str.match(/\d+$/);
    	return matches ? parseInt(matches[0], 10) : 0;
	}
	model_name.sort((a,b) => getLastNumber(a.product_code) - getLastNumber(b.product_code))

	var model_alldata = <?=$model_alldata?>;
	function getLastNumber(str) {
    	var matches = str.match(/\d+$/);
    	return matches ? parseInt(matches[0], 10) : 0;
	}
	model_alldata.sort((a,b) => getLastNumber(a.product_code) - getLastNumber(b.product_code))

	var connectors_images = <?=$connectors_images?>;
	var paralls_cons = [];
	var ss_v = [2,2.4,3,3.3,5,5.5,6,8,10,12,14,15,18,20,24,28,30,32,36,42,48,54,60];
	var do_v = [3.3,5,5.5,6,8,10,12,14,15,18,20,24,28,30];

	var ss_a = [45,45,45,45,45,45,42,25,25,25,21.4,20,16.7,15,12.5,10.7,10,9.4,8.3,7.1,6.3,5.5,5];
	var ts_a = [100,100,100,85.7,73.3,61.1,53,50,42.8,33.3,34.4,33.3,28.6,25,22.2,20];
	var do_a = [5,5,5,5,5,5,5,5,5,5,5,4,4,4];

	var ts_a_gobal = [100,100,100,85.7,73.3,61.1,53,50,42.8,33.3,34.4,33.3,28.6,25,22.2,20];
	var do_a_gobal = [5,5,5,5,5,5,5,5,5,5,5,4,4,4];

	var code = '';
	selectionGenerate();
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
	$("#configurable").steps({
		headerTag: "h3",
		bodyTag: "section",
		transitionEffect: "slideLeft",
		autoFocus: true,
		onStepChanged: function (event, currentIndex, priorIndex) {
			// $('.wizard > .content').height($('section.current').height());
			$('.actions > ul > li:first-child').attr('style', 'display:block');
			var index_pr = $('#model').children("option:selected").val();
			if(currentIndex === 0){
				$('.wizard > .actions').attr('style', 'border: 2px solid transparent;');
				$('a[href$="previous"]').attr('style', 'display:none');
                $('a[href$="next"]').attr('style', 'display:block');
				$('a[href$="next"]').text('{{$staticContent['Select_Output(s)']}}');
			}
			if(currentIndex === 1){
				$('.wizard > .actions').attr('style', 'border: 2px solid transparent;');
				$('a[href$="previous"]').attr('style', 'display:block');
				$('a[href$="previous"]').text('{{$staticContent['Select_Model']}}');
                $('a[href$="next"]').text('{{$staticContent['Select_Parallel']}}');
				$('a[href$="previous"]').removeClass("btn-enquiry");
				$('a[href$="previous"]').addClass("btn-previous-border");
				loadparallel(model_alldata[index_pr]['translate_id'] ,model_alldata[index_pr]['max_slot']);

                //Call validation function
                validateDualInputs();
            }
			if(currentIndex === 2){
				setActive();
				$('.wizard > .actions').attr('style', 'border: 2px solid transparent;');
				$('.wizard > .content').attr('style', 'border-bottom: 2px solid #E3EFF8;');
				$('a[href$="previous"]').attr('style', 'display:block');
				$('a[href$="previous"]').text('{{$staticContent['Select_Output(s)']}}');
				$('a[href$="next"]').text('{{$staticContent['Summary']}}');
				$('a[href$="previous"]').removeClass("btn-enquiry");
				$('a[href$="previous"]').addClass("btn-previous-border");
				// $('.wizard > .content').height($('section.current').height()+60);
			}

			if(currentIndex === 3){
				setCode();
				$('.wizard > .actions').attr('style', 'border: 2px solid #E3EFF8;');
				$('.wizard > .content').attr('style', 'border-bottom: unset;');
				$('a[href$="previous"]').attr('style', 'display:block');
				$('a[href$="previous"]').text('{{$staticContent['Enquiry']}}');
				$('a[href$="previous"]').removeClass("btn-previous-border");
				$('a[href$="previous"]').addClass("resetenqu");
				$('a[href$="previous"]').attr('id','submitenquiry');
				$('a[href$="previous"]').html('<button class="btn-enquiry" id="SbtRequest1" onclick="linktosupport();">{{$staticContent['Enquiry']}}</button>');
				$('a[href$="previous"]').attr("href" ,'#');


				var val = $('input[name=parallel]:checked').val();
				$('#configurable-p-3 tbody tr').addClass('d-none');
				$('#configurable-p-3 #parallel'+ val).removeClass('d-none');
				$('#configurable-p-3 tbody tr td:first-child ' ).addClass('d-none');
				$('#configurable-p-3 thead tr td:first-child ' ).addClass('d-none');
				$('#parallel'+ val +' input[name=parallel-2]').prop( "checked", true );
				// $('.wizard > .content').height($('section.current').height()+90);
				$('#savedataauto').click();


			}

		},

		/* enableFinishButton: false, */
		labels: {
			next: "{{$staticContent['Select_Output(s)']}}",
			finish: "{{$staticContent['Send']}} PDF"
		}
	});

	$('a[href$="finish"]').attr('data-toggle', 'modal');
	$('a[href$="finish"]').addClass("enquiry-bg");
	$('a[href$="finish"]').attr('data-target', '#sentToPDF');
	$('a[href$="finish"]').attr('id', 'sentToPDFMe');
	$('a[href$="previous"]').attr('style', 'display:none');
	$('a[href$="previous"]').addClass("btn-previous-border");
	$('a[href$="next"]').addClass("arrow-next");

	var current = $('.wizard > .content').height();
	function linktosupport(){
		$('#stateSelectbth').val(1);
		if(checkvalueConfOnly()){
			window.location  = "{{route('contactSupport')}}";
		}else{
			$('#loaderSavefile').css("display",'block');
		}

	}
	function checkvalueConfOnly(){
		var value = $('#con_id').val();
       if(value != null && value != '' ){
          return true;
	   }
	}
	function checkValueConfigFile(){
		var state = $('#stateSelectbth').val();
	   if(state == 1){
		  linktosupport();
	   }else if(state == 2){
		checkConfigFilefrom();
	   }
	}
	function checkConfigFilefrom(){
		// alert('checkfile');
		  $('#stateSelectbth').val(2);
		   if(document.configform.config_id.value == '' || document.configform.config_id.value == null) {
			$('#loaderSavefile').css("display",'block');
			// alert('testconf');
			return false;
		   }else if(document.configform.keyrecap.value == '' || document.configform.keyrecap.value == null ){
		    alert('Please verify you are not a robot')
			return false;
		   }else if(!document.configform.prichk.checked){
			alert('Please accept Privacy Policy checkbox to continue')
			return false;
		   }else {
			  if($('#keyrecap').val() != '' && $('#keyrecap').val() != null){
				document.configform.submit();
			  }
            }
	}

	function selectionGenerate(){
		$.each(model_name , function(index,value){

			$('#model').append('<option value="'+index+'">'+value['product_code']+'</option>');
		});
		$('#model').children("option:first-child").attr('selected','selected');
		loadData();
	}

	function loadData(){
		$('#slot').empty();
		var index = $('#model').children("option:selected").val();
		$('.text-info').html(model_alldata[index]['description']);
		$('#img-fistdata').html('<img class="img-model " src="{{config('app.url')}}/media/model/'+model_alldata[index]['thumb_img']+'">');
		$('.img-summary-add').html('<img class="img-fluid" src="{{config('app.url')}}/media/model/'+model_alldata[index]['thumb_img']+'" >');


		$('#certificate').html('<img class="" src="{{config('app.url') }}/media/model/'+model_alldata[index]['certificate_img']+'">');
		var l = parseFloat(model_alldata[index]['dimensions']);
		var w = parseFloat(model_alldata[index]['dimen_w']);
		var d = parseFloat(model_alldata[index]['dimen_d']);
		var weight = parseFloat(model_alldata[index]['weight']);

		$('.c_delta_inc').html((l/25.4).toFixed(2) + '" x ' + (w/25.4).toFixed(2) + '" x ' + (d/25.4).toFixed(2) + '"');
		$('.c_delta_mm').html(l + ' x ' + w + ' x ' + d + ' mm');
		$('.c_delta_weight').html(weight+'kg ('+(weight*2.205).toFixed(2)+'lb)');
		$('#port').empty();

		for(var i = 0 ; i < model_alldata[index]['max_slot']; i++){
			$('#port').append('<div class="fix-height col-2  bg-gray" id="port1">Blank</div>');
		}
		$('#bg-slot').addClass("bg-sixslot");
		$('#bg-slot02').addClass("bg-sixslot");
		// if(model_alldata[index]['max_slot'] === 6){
		// 	$('#bg-slot').removeClass("bg-fourslot");
		// 	$('#bg-slot02').addClass("bg-sixslot");
		// 	$('#bg-slot02').removeClass("bg-fourslot");
		// }else if(model_alldata[index]['max_slot'] === 4){
		// 	$('#bg-slot').removeClass("bg-sixslot");
		// 	$('#bg-slot').addClass("bg-fourslot");
		// 	$('#bg-slot02').removeClass("bg-sixslot");
		// 	$('#bg-slot02').addClass("bg-fourslot");
		// }
	     var ts_a_700 = [78.7,70,58.3,50,46.7,38.9,35,29.2,25,23.3,21.9,19.4,16.7,14.6,13,11.7];
     	 var do_a_700 = [5,5,5,5,5,5,5,5,5,5,4.5,3.7,3.2,3];
		 var index = $('#model').children("option:selected").val();
		 if(model_alldata[index]['max_power'] == 700){
			do_a = do_a_700;
			ts_a = ts_a_700;
			$('#bus').empty();
			$("#bus").append(new Option("{{$staticContent['default_N_A']}}", "0"));

		 }else{
			do_a = do_a_gobal;
			ts_a = ts_a_gobal;
			$('#bus').empty();
			$("#bus").append(new Option("{{$staticContent['default_PMBus']}}", "0"));
			$("#bus").append(new Option("{{$staticContent['RS232_adapter']}}", "1"));
			$("#bus").append(new Option("{{$staticContent['USB_adapter']}}", "2"));
			$("#bus").append(new Option("{{$staticContent['RS485_adapter']}}", "3"));
		 }
		 if(model_alldata[index]['max_power'] == 3000){

				$('#terminal').empty();
                $("#terminal").append(new Option("{{$staticContent['t_for_american_terminal']}}", "1"));
				$("#terminal").append(new Option("{{$staticContent['e_for_european_terminal']}}", "2"));
				$("#terminal").append(new Option("{{$staticContent['c_for_c14']}}", "3"));

				$('#logic').empty();
				$("#logic").append(new Option("{{$staticContent['Normal_Logic_&_Normal_Fan_Direction']}}", "0"));
				$("#logic").append(new Option("{{$staticContent['Reversed_Logic_&_Normal_Fan_Direction']}}", "1"));
				$("#option_ti").attr('data-original-title', '{{$staticContent['Inlet_Type_description_MEG-3K0A9']}}');
		}else if(model_alldata[index]['max_power'] == 700){
		        $('#terminal').empty();
                $("#terminal").append(new Option("{{$staticContent['t_for_american_terminal']}}", "1"));
				$("#terminal").append(new Option("{{$staticContent['e_for_european_terminal']}}", "2"));
				$("#terminal").append(new Option("{{$staticContent['c_for_c14']}}", "3"));

				$('#logic').empty();
				$("#logic").append(new Option("{{$staticContent['Normal_Logic_&_Normal_Fan_Direction']}}", "0"));
				$("#logic").append(new Option("{{$staticContent['Reversed_Logic_&_Normal_Fan_Direction']}}", "1"));
				$("#option_ti").attr('data-original-title', '{{$staticContent['Inlet_Type_description']}}');

		}else{

				$('#terminal').empty();
				$("#terminal").append(new Option("{{$staticContent['t_for_american_terminal']}}", "1"));
				$("#terminal").append(new Option("{{$staticContent['e_for_european_terminal']}}", "2"));
				$("#terminal").append(new Option("{{$staticContent['c_for_c14']}}", "3"));

				$('#logic').empty();
				$("#logic").append(new Option("{{$staticContent['Normal_Logic_&_Normal_Fan_Direction']}}", "0"));
				$("#logic").append(new Option("{{$staticContent['Reversed_Logic_&_Normal_Fan_Direction']}}", "1"));
				$("#logic").append(new Option("{{$staticContent['Normal_Logic_&_Reversed_Fan_Direction']}}", "2"));
				$("#logic").append(new Option("{{$staticContent['Reversed_Logic_&_Reversed_Fan_Direction']}}", "3"));
				$("#option_ti").attr('data-original-title', '{{$staticContent['Inlet_Type_description']}}');

			}

		 loadparallel(model_alldata[index]['translate_id'] ,model_alldata[index]['max_slot']);
			getSelectConnector(model_alldata[index]['translate_id'],model_alldata[index]);
		//addMoreOutput();
		$('.slot').empty();
		addSlotOutput();

	}

	function getSelectConnector(proId ,model){
	if(connectors_images.length > 0){
		$('#terminal').empty();
		$.each(connectors_images,function(index,value){
	     if(value.product_id == proId){
							if(value.value == 1){
									if(value.image){
										$('.img-summary-add').html('<img class="img-fluid" src="{{config('app.url')}}/upload/thumbs/'+value.image+'" >');
									}else{
										$('.img-summary-add').html('<img class="img-fluid" src="{{config('app.url')}}/media/model/'+model['thumb_img']+'" >');
									}
					  	}
								$("#terminal").append(new Option(value.code, value.value));
						}
		});
	}

	}
	function loadparallel(id, max_slot){
		$.ajax({
					url: "{{route('loadparallercon')}}",
					data: {'model_id': id},
					type: 'POST',
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					success: function(data){
						paralls_cons = data.data;
						renderTable(max_slot,'parallel',paralls_cons,'data_tableslot');
						renderTable(max_slot,'parallel-2',paralls_cons,'data_table2_con');
					},
					error: function(data){
						console.log(data);
						}
			});

	}

    function validateDualInputs() {
        //Check valued input
        function checkValidity() {
            //Define variables
            let isValid = true;

            $('.child-slot').each(function () {
                const selectedRadio = $(this).find('input[type="radio"]:checked');

                // Check if dual output is selected
                if (selectedRadio.attr('id') && selectedRadio.attr('id').includes('dual')) {
                    // Check voltage
                    $(this).find('.voltage select').each(function () {
                        if ($(this).val() === '-1') {
                            isValid = false;
                        }
                    });

                    // Check current
                    $(this).find('.current select').each(function () {
                        if ($(this).val() === '-1') {
                            isValid = false;
                        }
                    });
                }

                // Check if single output is selected
                if (selectedRadio.attr('id') && selectedRadio.attr('id').includes('single')) {
                    // Check voltage
                    $(this).find('.voltage select').each(function () {
                        if ($(this).val() === '-1') {
                            isValid = false;
                        }
                    });

                    // Check current
                    $(this).find('.current select').each(function () {
                        if ($(this).val() === '-1') {
                            isValid = false;
                        }
                    });

                }
            });

            // Disable or enable the button based on validation
            const nextButton = $('a[href$="next"]');
            if (isValid) {
                nextButton.css('display', 'block');
            } else {
                if (nextButton.text() === '{{$staticContent["Select_Parallel"]}}') {
                    nextButton.css('display', 'none');

                }
            }
        }

        // Call validation on page load
        checkValidity();

        // Run validation on any change in inputs or selects
        $(document).on('change', '.child-slot input[type="radio"], .child-slot select', function () {
            checkValidity();
        });
    }

	function addSlotOutput(){
		if(checkSlotMax()){
			var index = $('#model').children("option:selected").val();
			alert('You have reached maximum slot of '+model_alldata[index]['product_code']+' ('+model_alldata[index]['max_slot']+' slots)');
			return;
		}


		var index = indexBetween();
		var text = '';
		text +='<div class="child-slot row add-space-mobile" id="child-'+index+'">';
		text +='<input type="hidden" name="index" value="'+index+'"/>';
		text +='<input type="hidden" name="slot" value="1"/>';
		text +='<div class="col-3">';
		text +='<p class="">{{$staticContent['Slot']}} '+index+'</p>';
		text +='</div>';
		text +='<div class="col-9">';
		text +='<div class="form-check form-check-inline">';
		text +='<input class="form-check-input" type="radio" onchange="getSelecter(this);" name="slot-type-'+index+'" id="single'+index+'" value="1">';
		text +='<label class="form-check-label" for="single'+index+'">{{$staticContent['Single_Slot']}}</label>';
		text +='</div>';
		text +='<div class="form-check form-check-inline">';
		text +='<input class="form-check-input" type="radio" onchange="getSelecter(this);" name="slot-type-'+index+'" id="dual'+index+'" value="2">';
		text +='<label class="form-check-label" for="dual'+index+'">{{$staticContent['Dual_Slot']}}</label>';
		text +='</div>';
		text +='</div>';
		text +='</div>'
		if(index > countSlot()){
			$('.slot').append(text);
		}else{
			var count = 0;
			var after_index = 0;

			$.each($('.slot .child-slot'),function(index2,el){
				count += parseInt($(el).children('input[name=slot]').val())
				if(count < index){
					after_index = $(el).children('input[name=index]').val();
				}else{
					$('.slot #child-'+(after_index)).after(text);
					return false;
				}
			})

		}
		$('.slot #child-'+index+' #single'+index+'').click();
		$('.slot #child-'+index+' #single'+index+'').attr('checked', 'checked');
		// $('#numoutput').text(index);
		checkSlotMax();

	}

	function getSelecter(_this){
		var type = $(_this).val();
		var index = $(_this).parent().parent().parent().children('input[name=index]').val();
		var text = '';

		for(var i = 0 ; i < type ; i++){

			text += '<div class="w-100 select-box my-1 d-flex flex-wrap" id="select-box'+i+'">';
			text += '<div class="voltage col-4 column-select">';
			text += '<select class="form-control" onchange="getSelectCurrent(this,'+type+'); getToSum('+i+');" id="volt'+i+'">';
			text += '<option value="-1">';
			text += '{{$staticContent['voltage']}} '+index;
			text += (type == 2) ? '.'+(i+1):'';
			text += '</option>';
			text += getSelectVoltage(type);
			text += '</select>';
			text += '</div>';
			text += '<div class="current col-4 column-select">';
			text += '<select class="form-control" >';
			text += '<option value="-1">';
			text += '{{$staticContent['current']}} '+index;
			text += (type == 2) ? '.'+(i+1):'';
			text += '</option>';
			text += '</select>';
			text += '</div>';
			text += '<div class="input col-3 column-input">';
			text += '<input type="text" name="watt[]" class="form-control" value="" disabled="disabled" placeholder="{{$staticContent['power']}} '+index;
			text += (type == 2) ? '.'+(i+1):'';
			text += '" >';
			text += '</div>';
			text += '<div class=" col-1 column-back">';
			if(i==0){
				text += '<div class="btn-undo-icon" onclick="resetData('+index+')">';
				text += '</div>';
				if(index != 1){
					text += '<div class="btn-remove" onclick="removeData(this);"">';
					text += '</div>';
				}
			}
			text += '</div>';
			text += '</div>';
		}
		$(_this).parent().parent().parent().children('.select-box').remove();
		$(_this).parent().parent().parent().children('input[name=index]').val(index);
		setValueSlot($(_this).parent().parent().parent());
		$(_this).parent().parent().parent().children('input[name=slot]').val(1);
		$(_this).parent().parent().parent().children('.col-3').children('p').html('Slot '+index);
		$(_this).parent().parent().parent().append(text);
		setHeight();
		setModelPreview();
		setModelPreviewToSum();


	}
	function getToSummary02(i){
		// alert("55555555555");
	}
	function getSelectVoltage(type,i){
		var text = '';
		var array_v = (type == 1) ? ss_v : do_v;
		$.each(array_v,function(index,value){
			text += '<option value="'+index+'">';
			text += value;
			text += '</option>';
		});
		return text;
	}

	function getSelectCurrent(_this,type){
		var parent = $(_this).parent().parent();
		var value = $(_this).children("option:selected").val();
		var text = '';
		var array_v = (type == 1) ? ss_v : do_v;
		var array_a = (type == 1) ? ss_a : do_a;


		text += '<select class="form-control" onchange="currentChange(this,'+type+')" >';
		text += '<option value="'+array_a[value]+'">';
		text += parseFloat(array_a[value]).toFixed(2)+'A';
		text += '</option>';

		if(value > 6 && type == 1){
			text += '<option value="'+ts_a[value-7]+'">';
			text += parseFloat(ts_a[value-7]).toFixed(2)+'A';
			text += '</option>';
		}
		text += '</select>';
		parent.children('.current').empty();
		parent.children('.current').append(text);

		parent.children('.input').children('input').val(parseFloat(array_a[value]*array_v[value]).toFixed(1));
		setValueSlot(parent.parent());
		setModelPreview();
		setModelPreviewToSum();
		checkSumwatt();
		checkSlotMax();
	}
	function checkSumwatt(){
		var sum_watt = sumWatt();
		var index = $('#model').children("option:selected").val();
		// console.log(sum_watt , model_alldata[index]['max_power']);
	    if(sum_watt > model_alldata[index]['max_power']){
				alert('Total output power is over '+model_alldata[index]['max_power']+'W(Maximum). Please confirm actual total power needed is within PSU limit and continue the configuration');
				$('input[name=power]').val(model_alldata[index]['max_power']);
				$("#sumpower").text(model_alldata[index]['max_power']+"W");
				$("#sumpower-pdf").text(model_alldata[index]['max_power']+"W");
		}
	}

	function currentChange(_this,type){
		var parent = $(_this).parent().parent();
		var value = parent.children('.voltage').children('select').children("option:selected").val();
		var current = $(_this).children('option:selected').val();
		var array_v = (type == 1) ? ss_v : do_v;
		parent.children('.input').children('input').val(parseFloat(array_v[value]*current).toFixed(0));

		setValueSlot($(_this).parent().parent().parent());
		setModelPreview();
		setModelPreviewToSum();
		checkSumwatt();
		checkSlotMax();

	}

	function setValueSlot(_this){
		var parent = $(_this);
		var amp = parent.children().children('.input').children('input').val();

		var _index = parseInt(parent.children('input[name=index]').val());
		var maxvalue  = 800;
		var indexmo_ = $('#model').children("option:selected").val();
		var max_slot = model_alldata[indexmo_]['max_slot'];
		if(max_slot == 3){
			maxvalue = 630;
		}
		if(amp >= maxvalue){
			// console.log(!checkSlotMax(2));
			// console.log(countSlot()+2);
			// console.log(!checkSlotMax(2) ,'Slot more than 800');
			if(!checkSlotMax(2)){
				parent.children('input[name=slot]').val(3);
				parent.children('.col-3').children('p').html('{{$staticContent['Slot']}}'+_index+' - '+(_index+2));
				var lastindex = $('.slot .child-slot:last-child input[name=index]').val();
				if(_index < lastindex){
					var this_val = 0;
					var this_index = '';
					$.each($('.slot .child-slot'),function(index,value){
						if($(value).children('input[name=index]').val() > _index){
							this_val = parseInt($(value).children('input[name=index]').val())+2;
							$(value).prop('id','child-'+this_val);
							$(value).children('input[name=index]').val(this_val);
							// $(value).children('p').text(this_val);
							this_index = ($(value).children('input[name=slot]').val() != 1) ? this_val+' - '+(this_val+2) : this_val;
							$(value).children('.col-3').children('p').html('{{$staticContent['Slot']}} '+this_index);
							$(value).children('.select-box').children('.col-3:last-child').children('.btn-undo-icon').attr('onclick','resetData('+this_val+')');

							$(value).children('.col-9').children('.form-check:first-child').children('input').attr('name','slot-type-'+this_val);
							$(value).children('.col-9').children('.form-check:first-child').children('input').attr('id','single'+this_val);
							$(value).children('.col-9').children('.form-check:first-child').children('label').attr('for','single'+this_val);

							$(value).children('.col-9').children('.form-check:last-child').children('input').attr('name','slot-type-'+this_val);
							$(value).children('.col-9').children('.form-check:last-child').children('input').attr('id','dual'+this_val);
							$(value).children('.col-9').children('.form-check:last-child').children('label').attr('for','dual'+this_val);
						}
					});
				}
			}else{
				var index = $('#model').children("option:selected").val();
				alert('You have reached maximum slot of '+model_alldata[index]['product_code']+' ('+model_alldata[index]['max_slot']+' slots)');
				var index = parent.children('input[name=index]').val();
				$('.slot #child-'+index+' #dual'+index+'').click();
				$('.slot #child-'+index+' #single'+index+'').click();
			}
		}else{
			if(parent.children('input[name=slot]').val() == 3){
				parent.children('.col-3').children('p').html('{{$staticContent['Slot']}}'+_index);
				$.each($('.slot .child-slot'),function(index,value){
					if($(value).children('input[name=index]').val() > _index){
						this_val = parseInt($(value).children('input[name=index]').val())-2;
						$(value).prop('id','child-'+this_val);
						$(value).children('input[name=index]').val(this_val);
						this_index = ($(value).children('input[name=slot]').val() != 1) ? this_val+' - '+(this_val+2) : this_val;
						$(value).children('.col-3').children('p').html('{{$staticContent['Slot']}} '+this_index);
						$(value).children('.select-box').children('.col-3:last-child').children('.btn-undo-icon').attr('onclick','resetData('+this_val+')');
					}
				});
				parent.children('input[name=slot]').val(1);
			}
		}
	}
	function setModelPreviewToSum(){
		setCode();
		var index = $('#model').children("option:selected").val();
		var max_slot = model_alldata[index]['max_slot'];

		var checked = false;
		var text = '';
		var _value = null;
		var watt = 0;
		var array_v = ss_v;
		var array_a = ss_a;
		var voltage_index = -1;
		var class_col = 'col-2';
		$('#list-slot').empty();

		for(var i = 1 ; i <= max_slot  ; i++){
			_value = $('.slot #child-'+i);
			text = '';
			if($(_value).children('.select-box').length > 0){
			text += '<img src="{{asset('frontend-asset/image/bullet.svg')}}" >';
			}
			if($(_value).children('.select-box').length > 0){
				$.each($(_value).children('.select-box'),function(index,value){
				if($(value).children('.input').children('input').val() > 0){


						if(index > 1){
							text += '<br>';
							text += '----------';
							text += '<br>';
						}
						if($(_value).children('.select-box').length > 1){
							text += " ";
							text += 'Output '+(index+1)+' : ';
						}
							array_v = ($(_value).children('.select-box').length == 1) ? ss_v : do_v;
							voltage_index = $(value).children('.voltage').children('select').children('option:selected').val();
							text += " ";
							text += array_v[voltage_index]+'V, ';
							text += $(value).children('.current').children('select').children('option:selected').val()+'A, ';
							text += $(value).children('.input').children('input').val()+'W';
							if($(_value).children('.select-box').length > 1)
							text += ' (' + String.fromCharCode(67+parseInt(voltage_index) + 1)+')'
							else
							text += ' (' + String.fromCharCode(64+parseInt(voltage_index) + 1)+''+  ($(_value).children('input[name=slot]').val() == 1 ? 1 : 2) +')';

							if($(_value).children('.select-box').length > 0 && $(_value).children('.select-box').length != (index+1) ){
								text +=", ";
							}
					}
		     	});
				           if($(_value).children('.select-box').length > 0 ){
								text +="<br>";
							}
			}

			$('#list-slot').append(text);

		}
	}
	function setModelPreview(){
		var index = $('#model').children("option:selected").val();
		var max_slot = model_alldata[index]['max_slot'];
		// console.log(max_slot);
		var checked = false;
		var text = '';
		var _value = null;
		var watt = 0;
		var array_v = ss_v;
		var array_a = ss_a;
		var voltage_index = -1;
		var class_col = 'col-2';
		text += '<div class="fix-col-box1 order-0"></div>';
		for(var i = 1 ; i <= max_slot  ; i++){
			if($('.slot #child-'+i).children('input[name=index]').val() == i){
				_value = $('.slot #child-'+i);
				if($(_value).children('input[name=slot]').val() == 1){
					class_col = ' blank ';
				}else{
					class_col = ' blank-large ';
					i+=2;
				}
				text += '<div class="fix-height '+class_col+'bg-gray  order-'+(15-i)+'" id="port'+(i)+'">';
				text += '<p>{{$staticContent['Slot']}}'+$(_value).children('input[name=index]').val()+'</p>';
				$.each($(_value).children('.select-box'),function(index,value){
					if($(value).children('.input').children('input').val() > 0){
						if(index > 1){
							text += '<br>';
							text += '----------';
							text += '<br>';
						}
						if($(_value).children('.select-box').length > 1){
							text += 'Output '+(index + 1)+' : ';
						}
						array_v = ($(_value).children('.select-box').length == 1) ? ss_v : do_v;
						voltage_index = $(value).children('.voltage').children('select').children('option:selected').val();

						text += array_v[voltage_index]+'V, ';
						text += $(value).children('.current').children('select').children('option:selected').val()+'A, ';
						text += $(value).children('.input').children('input').val()+'W';
						text += '<br>';
					}
				});
				text += '</div>';
			}else{
				text += '<div class="fix-height blank  bg-gray order-'+(15-i)+'" id="port'+(i)+'">Blank</div>';
			}


			$('#port').html(text);
			$('#port02').html(text);
			$('input[name=output_total]').val(countSlot());

			$('#numoutput').text(countSlot());

			var sum_watt = sumWatt();
			// console.log(sum_watt);

			if(sum_watt > 0){
				$('input[name=power]').val(sumWatt().toFixed(1));
				$("#sumpower").text(sumWatt()+"W");
				$("#sumpower-pdf").text(sumWatt()+"W");
			}else{
				$('input[name=power]').val('');
				$("#sumpower").text("-");
				$("#sumpower-pdf").text("-");
			}

		}
		$('#port').append('<div class="fix-col-box2 order-15"></div>');
		$('#port02').append('<div class="fix-col-box2 order-15"></div>');
	}

	function resetData(index){
		$('.slot #child-'+index+' #dual'+index+'').click();
		$('.slot #child-'+index+' #single'+index+'').click();
		setModelPreview();
		setModelPreviewToSum();
	}

	function removeData(_this){
		$(_this).parent().parent().parent().remove();
		checkSlotMax();
		setHeight();
		setModelPreview();
		setModelPreviewToSum();
        validateDualInputs();
	}

	function setHeight(){
		 /* $('.wizard > .content').height(current);
		 if($('.wizard > .content').height() < $('section.current').height()+60){
		 	$('.wizard > .content').height($('section.current').height()+60);
		 } */
	}

	function getModelData(){
		var index = $('#model').children("option:selected").val();
		return model_alldata[index];
	}

	function countSlot(){
		var count = 0;
		$.each($('.slot .child-slot'),function(index,value){
			count += parseInt($(value).children('input[name=slot]').val());
		});
		return count;
	}

	function indexBetween(){
		var count = countSlot();
		var _index =  (countSlot()+1);
		var slot_add = 0;
		var lastindex = $('.slot .child-slot:last-child input[name=index]').val();
		if(lastindex != undefined && parseInt(lastindex) != count){
			lastindex = parseInt(lastindex);
			_index = 1;
			var child = $('.slot .child-slot');
			$.each($('.slot .child-slot'),function(index,value){
				//var sumindex = index + slot_add +1;

				if($(value).children('input[name=index]').val() == (index + slot_add + 1) && _index !=  (countSlot()+1)){

					_index += parseInt($(value).children('input[name=slot]').val());

				}
				slot_add += parseInt($(value).children('input[name=slot]').val()-1);




				/* alert("val:"+$(value).children('input[name=index]').val()+"index:"+index+"_index:"+_index+"slot_add:"+slot_add +"sum:"+(index + slot_add + 1)+"count:"+(countSlot()+1)); */

			});
		}
		return _index;
	}
	// var addon = 0;
    function renderTable(slot,name,paralles,where_is){
		// console.log(paralles);
    var html = '';
	    html += '<table class="w-100 parallel"style="margin-top:12px;">';
	    html += '<thead>';
		html += '<tr class="header-td">';
		html +=	'<td ></td>';
		html +=	'<td>Code</td>';
        for(var i = 1; i <= slot ;i++){
	     html +=	'<td>{{$staticContent['Slot']}}'+i+'</td>';
	    }
		html +=	'</tr>';
		html +=	'</thead>';
		html +=	'<tbody>';

		html += '<tr id="parallel0">';
		html +='<td style=""><input class="d-p-cal" type="radio" value="0" name="'+name+'" checked="checked"><label></label></td>';
		html +=	'<td>0</td>';
		html +=	'<td colspan="'+slot+'"></td>';
		html +=	'</tr>';
		$.each(paralles,function(index,value){
		html +=	'<tr id="parallel'+value['code']+'">';
		html +=	'<td class="input"><input class="d-p-cal" type="radio" value="'+value['code']+'" name="'+name+'"><label></label></td>';
		html +=	'<td>'+value['code']+'</td>'
        var arrche  = value['space_using'].split(',');
       for(var j = 0 ; j < arrche.length ;j++ ){
		// console.log(j);
		   if(arrche[j] == 1 && typeof arrche[j+1] != 'undefined' && arrche[j+1] == 1){
				html +=	'<td colspan="2" class="line">'
				html +=	'<div class="bg-box h-25 w-75 mx-auto rounded"></div>'
				html +=	'</td>';
				j = j+1;
		   }else{
			    html +='<td colspan="1"></td>';
		   }

	   }
		html +=	'</tr>';
		});
		html += '</tbody>';
		html +=	'</table>';

		$('#'+where_is).html(html);

	}
	function checkSlotMax(addon){

		if(addon == undefined || addon == 'undefined' ){
			addon = 0;
		}

		var index = $('#model').children("option:selected").val();
		if(countSlot()+addon > model_alldata[index]['max_slot']){
			return true;
		}

		if(countSlot()+addon >= model_alldata[index]['max_slot']){
			$('#addmore').addClass('d-none');
		}else{
			$('#addmore').removeClass('d-none');
		}


		return false;
	}
	function checkOutputMax(){
	    var ouput =	$('#power').val();
	}

	function sumWatt(){
		var sum_watt = 0;
		$('input[name^="watt"]').each(function() {
			if($(this).val() > 0)
				sum_watt += parseFloat($(this).val());
		});
		return sum_watt;
	}

	function setActive(){
		$('.parallel td').removeClass('active');
		var index = $('#model').children("option:selected").val();
		var voltage_index = 0;
		var voltage_next_index = 0;
		var amp_index = 0;
		var amp_next_index = 0;
		var watt_index = 0;
		var watt_next_index = 0;
		$('input[name=parallel]').attr('disabled','disabled');
		$('#parallel0 input[name=parallel]').removeAttr('disabled');
        //console.log(paralls_cons);

		$.each(paralls_cons,function(indexPar,valuePar){
			var arrcheck = [];
			for(var i = 1 ; i <  model_alldata[index]['max_slot'] ; i++){
				// console.log($('#child-'+i+' input[name=slot-type-'+i+']:checked' ).val());
		    if($('#child-'+i+' input[name=slot-type-'+i+']:checked').val() == 1){
				voltage_index = parseFloat(ss_v[$('#child-'+i+' .select-box .voltage select').val()]);
				voltage_next_index = parseFloat(ss_v[$('#child-'+(i+1)+' .select-box .voltage select').val()]);
				amp_index = parseFloat($('#child-'+i+' .select-box .current select').val());
				amp_next_index = parseFloat($('#child-'+(i+1)+' .select-box .current select').val());
				watt_index = voltage_index*amp_index;
				watt_next_index = voltage_next_index*amp_next_index;
					if(voltage_index == voltage_next_index && amp_index == amp_next_index ){
						arrcheck.push(i.toString()+(i+1).toString());
						// arrcheck.push(i+1);
					}
		     	}


		    }
			     var slot_using  = valuePar['slot_using'].split(',');
			     var Canparallel = checkAllSlot(arrcheck,slot_using);
				//console.log(Canparallel,arrcheck, slot_using);
					if(Canparallel){
							$('#parallel'+valuePar['code']+' input[name=parallel]').removeAttr('disabled');
							$('#parallel'+valuePar['code']+' .line').addClass('active');
					}


		});




		// for(var i = 1 ; i <  model_alldata[index]['max_slot'] ; i++){
		// 	if($('#child-'+i+' input[name=slot-type-'+i+']').val() == 1){
		// 		voltage_index = parseFloat(ss_v[$('#child-'+i+' .select-box .voltage select').val()]);
		// 		voltage_next_index = parseFloat(ss_v[$('#child-'+(i+1)+' .select-box .voltage select').val()]);
		// 		amp_index = parseFloat($('#child-'+i+' .select-box .current select').val());
		// 		amp_next_index = parseFloat($('#child-'+(i+1)+' .select-box .current select').val());
		// 		watt_index = voltage_index*amp_index;
		// 		watt_next_index = voltage_next_index*amp_next_index;
		// 		if(voltage_index == voltage_next_index && amp_index == amp_next_index ){
		// 			//console.log(String.fromCharCode(64+i));
		// 			$('#parallel'+String.fromCharCode(64+i)+' input[name=parallel]').removeAttr('disabled');
		// 			$('#parallel'+String.fromCharCode(64+i)+' .line').addClass('active');
		// 		}
		// 	}
		// }

		// if(!$('#parallelA input[name=parallel]').is(":disabled") && !$('#parallelC input[name=parallel]').is(":disabled")){
		// 	$('#parallelF input[name=parallel]').removeAttr('disabled');
		// 	$('#parallelF .line').addClass('active');
		// }
		// if(!$('#parallelA input[name=parallel]').is(":disabled") && !$('#parallelD input[name=parallel]').is(":disabled")){
		// 	$('#parallelG input[name=parallel]').removeAttr('disabled');
		// 	$('#parallelG .line').addClass('active');
		// }
		// if(!$('#parallelA input[name=parallel]').is(":disabled") && !$('#parallelE input[name=parallel]').is(":disabled")){
		// 	$('#parallelH input[name=parallel]').removeAttr('disabled');
		// 	$('#parallelH .line').addClass('active');
		// }
		// if(!$('#parallelA input[name=parallel]').is(":disabled") && !$('#parallelC input[name=parallel]').is(":disabled") && !$('#parallelE input[name=parallel]').is(":disabled")){
		// 	$('#parallelI input[name=parallel]').removeAttr('disabled');
		// 	$('#parallelI .line').addClass('active');
		// }
		// if(!$('#parallelB input[name=parallel]').is(":disabled") && !$('#parallelD input[name=parallel]').is(":disabled")){
		// 	$('#parallelJ input[name=parallel]').removeAttr('disabled');
		// 	$('#parallelJ .line').addClass('active');
		// }
		// if(!$('#parallelB input[name=parallel]').is(":disabled") && !$('#parallelE input[name=parallel]').is(":disabled")){
		// 	$('#parallelK input[name=parallel]').removeAttr('disabled');
		// 	$('#parallelK .line').addClass('active');
		// }
		// if(!$('#parallelC input[name=parallel]').is(":disabled") && !$('#parallelE input[name=parallel]').is(":disabled")){
		// 	$('#parallelL input[name=parallel]').removeAttr('disabled');
		// 	$('#parallelL .line').addClass('active');
		// }
	}
	function checkAllSlot(arrHas , arrUsing){
		var checkre = false;
		var cherow = [];
		for(var j = 0 ; j < arrUsing.length ;j++ ){
			if(typeof arrUsing[j+1] != 'undefined'){
				// console.log(val+arrUsing[index+1] ,arrHas);
				checkre = includes_data(arrHas,(arrUsing[j]+arrUsing[j+1]).toString());
				cherow.push(checkre);
				j = j+1;
			}
		}

		var chKR = includes_data(cherow,false);
		if(chKR){
			checkre = false;
		}
	//   console.log(cherow ,chKR ,arrHas ,arrUsing );
		return checkre;
	}
	function includes_data(container, value) {
			var returnValue = false;
			var pos = container.indexOf(value);
			if (pos >= 0) {
				returnValue = true;
			}
			return returnValue;
    }

	function setCode(){
		code = '';
		var voltage_index;
		var slot_index;
		var index = $('#model').children("option:selected").val();
		for (var i=1; i <= model_alldata[index]['max_slot']; i++) {
			if($('#child-'+i+' input[name=slot-type-'+i+']:checked').val() == 1){
				voltage_index = parseInt($('#child-'+i+' .select-box .voltage select').val())+1;
				slot_index = $('#child-'+i+' input[name=slot]').val();

				if(voltage_index > 0){
					code += String.fromCharCode(64+voltage_index)+''+ (slot_index == 1 ? 1 : 2);
					amp_index = parseFloat($('#child-'+i+' .select-box .current select').prop('selectedIndex'));
					if(amp_index > 0)
						i += 2
				}
				else
					code += 'NU';
			}else if($('#child-'+i+' input[name=slot-type-'+i+']:checked').val() == 2){
				voltage_index = parseInt($('#child-'+i+' #select-box0 .voltage select').val())+1;
				if(voltage_index > 0){
					if(parseInt($('#child-'+i+' #select-box1 .voltage select').val())+1 > 0){
						code += String.fromCharCode(67+voltage_index);
						voltage_index = parseInt($('#child-'+i+' #select-box1 .voltage select').val())+1;
						code += String.fromCharCode(67+voltage_index);
					}
				}
				else
					code += 'NU';
			}else {
				code += 'NU';
			}

			if(i < model_alldata[index]['max_slot']){
				code += '-';
			}
		}
		var terminal = $('#terminal').children('option:selected').val();
		var factory_code = '';
		factory_code += model_alldata[index]['product_code'];
		factory_code += (terminal == 1 ? 'T' : terminal ==2 ? 'E' : 'C');

		var all_code = '';
		all_code += $('input[name=parallel]:checked').val();
		all_code += $('#logic').children('option:selected').val();
		all_code += $('#bus').children('option:selected').val();
		all_code += 'AA';
		var frameCode = 'MEG-A';
		frameCode += calnumber(model_alldata[index]['max_power']) ;
		frameCode += 'F';
		frameCode += ''+model_alldata[index]['max_slot'];
		frameCode += (terminal == 1 ? 'T' : terminal ==2 ? 'E' : 'C');
		frameCode += 'AA';
		$('.factory').html(factory_code+' '+all_code);
		$('#factory').html("Frame : "+frameCode);
		$('#model-fac').html("Model : "+factory_code);
		$('.customer').html(factory_code+' '+code+' '+all_code);
		$('#customer').html(factory_code+' '+code+' '+all_code);
	}
	/* summary */
	$('#inlet').text($("#terminal option:selected").text());
	$('#commu').text($("#bus option:selected").text());
	$('#control-code').text($("#logic option:selected").text());
	function getToSummary(){
		$('#inlet').text($("#terminal option:selected").text());
		$('#commu').text($("#bus option:selected").text());
		$('#control-code').text($("#logic option:selected").text());
	}
	function getToTerimal(){
		var terminal = $('#terminal').children('option:selected').val();
		var index = $('#model').children("option:selected").val();
		var model = model_alldata[index];
   console.log('model',model['id']);
		$.each(connectors_images,function(index,value){
	   		if(value.product_id == model['id'] &&  terminal == value.value){
							 if(value.image){
									$('.img-summary-add').html('<img class="img-fluid" src="{{config('app.url')}}/upload/thumbs/'+value.image+'" >');
								}else{
									$('.img-summary-add').html('<img class="img-fluid" src="{{config('app.url')}}/media/model/'+model['thumb_img']+'" >');
								}
						}

		});
	}
	function getToSum(i){
		/* $('#list-slot').text($("#volt"+i+" option:selected").text()); */

	}
	function calnumber(num){
		var string =  num/1000;
	   if(string < 1){
		var data = num;
	   }else{
		var c = string.toString();
		var str = c.split('.');
	    var data = str[0] + 'K' + str[1]
	   }
	   return data;
	}

	function addToiframe(){

	// var headdd = document.body.innerHTML;
	 var data_pdf = $('#configurable-summary').html();
	 var doc = document.getElementById('PDFconfigurable').contentWindow.document;
	 doc.open();
	 doc.write(
            '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional //EN" "http://www.w3.org/TR/html4/loose.dtd">'+
            '<html><head>'+
			'<link rel="stylesheet" href="{{asset('/frontend-asset/css/bootstrap.min.css')}}" >'+
			'<link rel="stylesheet" href="{{asset('/frontend-asset/css/font.css')}}">'+
			'<link rel="stylesheet" href="{{asset('/frontend-asset/css/embepdf.css')}}">'+
		 '<link rel="stylesheet" href="{{asset('/frontend-asset/css/header-front.css')}}">'+
			'<link rel="stylesheet" href="{{asset('/frontend-asset/css/container.css')}}">'+
			'<link rel="stylesheet" href="{{asset('/frontend-asset/css/home.css')}}">'+
			'<link rel="stylesheet" href="{{asset('/frontend-asset/css/product.css')}}">'+
			'<link rel="stylesheet" href="{{asset('/frontend-asset/css/procompare.css')}}">'+
			'<link rel="stylesheet" href="{{asset('/frontend-asset/css/bulltetpdf.css')}}">'+
            '<\/style><\/head><body><\/body><\/html>'
        );
        doc.close();
        doc.body.innerHTML= data_pdf;
		$('#sentToPDFMe').css("display",'none');
		$("#SbtRequest1").prop('disabled', true);
		convertToPDF();
}

	function convertToPDF(){
		const filename  = 'configurable-power-selector.pdf';
		var tar = $("#PDFconfigurable").contents().find("#savethis")[0];
		html2canvas(tar,{
															// allowTaint: false,
											    	useCORS: true,
                onrendered: function(canvas) {
                	 //Returns the image data URL, parameter: image format and clarity (0-1)
		             	var pageData = canvas.toDataURL('image/png',1.0);
						//Default vertical direction, size ponits, format a4[595.28,841.89]
						var pdf = new jsPDF('p', 'pt', 'a4' ,true);
						// //Two parameters after addImage control the size of the added image, where the page height is compressed according to the width-height ratio column of a4 paper.
						 pdf.addImage(pageData, 'png', 20, 50, 555.28, (592.28/canvas.width * canvas.height));
						//  pdf.save(filename);
						 var blob = pdf.output('blob');
						 var model =  $('#model').children("option:selected").text();

						$('#model_name').val(model);
						var formData = new FormData();
                         formData.append('pdf',blob);
						 formData.append('modelcode', model);
						 formData.append('factory', $('.factory').text());
						 formData.append('customer',$('#customer').text());

						 savedatadataPdf(formData);


                }
              });


	}

	function savedatadataPdf(data){
		$.ajax({
					url: "{{route('savepdfConfig')}}",
					data: data,
					processData: false,
					contentType: false,
					type: 'POST',
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					success: function(data){
						$('#loaderSavefile').css("display",'none');
						$('#sentToPDFMe').css("display",'block');
						$("#SbtRequest1").prop('disabled', false);
						$('#con_id').val(data.con_id);
						// checkValueConfigFile();
					},
					error: function(data){
						console.log(data)
						}
					});

       }

</script>


@endsection
