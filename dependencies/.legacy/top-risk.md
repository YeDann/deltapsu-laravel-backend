# Project Knowledge Base

> Query: `sqlite3 .legacy/knowledge.db '<SQL>'`

## Common Queries
```
-- 改 X 會影響什麼?
SELECT depended_by, coupling_type FROM impact WHERE module = 'X';

-- X 的所有 method + 誰在呼叫?
SELECT method, callers, called_from FROM methods WHERE module = 'X';

-- 這個功能有哪些 class?
SELECT name, risk FROM domains WHERE domain = 'Search';

-- 跨 domain 最危險的方法?
SELECT * FROM danger_methods;

-- 隱藏耦合?
SELECT * FROM hidden_coupling;

-- 改了這個檔案等於改了什麼?
SELECT module FROM file_map WHERE file_path = 'app/Services/X.php';

-- X 的設計意圖?
SELECT method, content FROM comments WHERE module = 'X';

-- Facade 解析?
SELECT source_name, target_name, detail FROM implicit_coupling WHERE category = 'facade';
```

## Top Risk Modules

name                         risk      incoming  outgoing  cross_domain_methods  has_test  risk_score
---------------------------  --------  --------  --------  --------------------  --------  ----------
Controller                   CRITICAL  62        0         0                     0         129       
FrontendController           LOW       0         56        0                     0         61        
Kernel                       LOW       4         16        0                     0         29        
User                         MEDIUM    11        0         0                     0         27        
ProductsController           LOW       0         15        0                     0         20        
ProductCategoriesController  LOW       0         14        0                     0         19        
ConfigurableProduct          LOW       0         12        0                     0         17        
PartnerDetailController      LOW       0         10        0                     0         15        
DucumentController           LOW       0         9         0                     0         14        
EmailController              LOW       0         8         0                     0         13        
BackendUserController        LOW       0         7         0                     0         12        
PartnerController            LOW       0         7         0                     0         12        
ApplicationView              LOW       0         6         0                     0         11        
LanguageController           LOW       0         6         0                     0         11        
PartnerPageController        LOW       0         6         0                     0         11        
Contact                      LOW       2         1         0                     0         10        
DowloadGui                   LOW       2         1         0                     0         10        
FaqController                LOW       0         5         0                     0         10        
Forgetpass                   LOW       2         1         0                     0         10        
ImportController             LOW       0         5         0                     0         10        
SendPDF                      LOW       2         1         0                     0         10        
SendPDFFromFeedBack          LOW       2         1         0                     0         10        
StaticContentController      LOW       0         5         0                     0         10        
ThankFeedback                LOW       2         1         0                     0         10        
AboutUsController            LOW       0         4         0                     0         9         
