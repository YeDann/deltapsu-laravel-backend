## MODIFIED Requirements

### Requirement: 頁面視覺與互動功能完整保留
原有需求不變，額外新增：saleskit modal 表單必須包含隱私權核取方塊（必填），且 submit 行為改為呼叫後端 API。

#### Scenario: 未勾選隱私權時無法送出
- **WHEN** 使用者未勾選隱私權核取方塊直接點擊「下載」
- **THEN** 表單不送出，顯示錯誤提示

#### Scenario: 勾選並送出後觸發下載
- **WHEN** 使用者填妥所有必填欄位、勾選隱私權、點擊「下載」
- **THEN** 前端呼叫 `POST /landing/saleskit-request`，收到 download_url 後用 `<a download>` 觸發瀏覽器下載

#### Scenario: API 失敗時顯示錯誤
- **WHEN** API 回傳非 success 狀態
- **THEN** 按鈕恢復可點擊，頁面顯示錯誤訊息
