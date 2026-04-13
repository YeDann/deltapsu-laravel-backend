
## Legacy Knowledge Base

This project has a pre-analyzed knowledge base at `.legacy/knowledge.db`.
**Always query it before modifying code.**

### Quick Reference
```bash
# Before modifying ANY class — check impact:
sqlite3 .legacy/knowledge.db "SELECT name, risk, incoming, cross_domain_methods, has_test FROM modules WHERE name = 'ClassName';"

# What depends on this class?
sqlite3 .legacy/knowledge.db "SELECT source, type FROM edges WHERE target = 'ClassName';"

# What methods are called cross-domain?
sqlite3 .legacy/knowledge.db "SELECT method, callers, called_from FROM methods WHERE module = 'ClassName' AND callers >= 2;"

# Hidden coupling (git co-change but no static edge)?
sqlite3 .legacy/knowledge.db "SELECT * FROM hidden_coupling;"

# This file = which module?
sqlite3 .legacy/knowledge.db "SELECT module FROM file_map WHERE file_path LIKE '%FileName%';"

# Design intent (why was it written this way)?
sqlite3 .legacy/knowledge.db "SELECT method, content FROM comments WHERE module = 'ClassName';"
```
### Top Risk Modules (auto-generated)
```
name                         risk      refs  cross_dom  tested
---------------------------  --------  ----  ---------  ------
Controller                   CRITICAL  62    0          ✗     
FrontendController           LOW       0     0          ✗     
Kernel                       LOW       4     0          ✗     
User                         MEDIUM    11    0          ✗     
ProductsController           LOW       0     0          ✗     
ProductCategoriesController  LOW       0     0          ✗     
ConfigurableProduct          LOW       0     0          ✗     
PartnerDetailController      LOW       0     0          ✗     
DucumentController           LOW       0     0          ✗     
EmailController              LOW       0     0          ✗     
```

