---
globs: "app/**/*.php"
---

# Legacy Guard

You are working with a PHP file that has been pre-analyzed.
**Before modifying this file, check its impact.**

Run this BEFORE making changes:
```bash
sqlite3 .legacy/knowledge.db "
  SELECT m.name, m.risk, m.incoming, m.cross_domain_methods, m.has_test,
         GROUP_CONCAT(DISTINCT e.source) as depended_by
  FROM modules m
  LEFT JOIN edges e ON e.target = m.name
  WHERE m.file_path LIKE '%CURRENT_FILE%'
  GROUP BY m.name;
"
```

Replace CURRENT_FILE with the filename you're editing.

If risk is HIGH or CRITICAL:
1. List all callers before changing method signatures
2. Check cross-domain methods — they affect multiple features
3. If has_test = 0, consider writing a test FIRST
