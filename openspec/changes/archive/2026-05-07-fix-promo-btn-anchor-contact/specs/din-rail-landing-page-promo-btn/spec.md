## MODIFIED Requirements

### Requirement: 頁面視覺與互動功能完整保留
原有需求不變，額外修正：`#promo-mini-btn` SHALL 為錨點連結，點擊後捲動至 `#contact` section，而非開啟 promo-overlay modal。

#### Scenario: 點擊 promo-mini-btn 捲動至 contact
- **WHEN** 使用者點擊右下角的 `#promo-mini-btn`
- **THEN** 頁面平滑捲動至 `id="contact"` 的 section
