## MODIFIED Requirements

### Requirement: JP locale brand and event copy
JP 語系的品牌名稱與活動標題 SHALL 顯示為：
- `overview.event.line1`：`デルタ標準電源`
- `overview.event.line2`：`2026年 新製品発表イベント`
- `overview.title1`：`卓越したパワーを追求する`
- `hero.upcomingLabel`：`デルタ最新製品ラインナップ一覧`

#### Scenario: JP locale shows updated copy
- **WHEN** 使用者以 `/jp/` 語系造訪 landing page
- **THEN** 上述 4 個 key 的文字顯示為新版日文內容
