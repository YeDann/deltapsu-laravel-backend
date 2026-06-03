<?php

/*
| 經銷商（Office）分類的單一定義來源。
| 只維護下方這一份 key 清單（key = 分類資料表名）；其餘一律由規則推導：
|   pivot = 'office_has_' . key      （與 office 關聯的中介表）
|   field = key                      （表單／前台送出的欄位名）
|   label = 去掉 distributor_ 前綴後轉標題大小寫
| 新增分類時，只要在 $keys 加一個資料表名即可。
*/

$keys = [
    'distributor_specialized_application',
    'distributor_product_line',
    'distributor_service',
    'distributor_sales_territory',
    'distributor_certification',
];

$categories = [];
foreach ($keys as $key) {
    $categories[$key] = [
        'label' => ucwords(str_replace('_', ' ', preg_replace('/^distributor_/', '', $key))),
        'field' => $key,
        'pivot' => 'office_has_' . preg_replace('/^distributor_/', '', $key),
    ];
}

return [
    'categories' => $categories,
];
