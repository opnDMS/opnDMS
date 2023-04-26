The only thing needed to change to use the example database is to change up the database name to your own database name.


```sql
--
-- Datenbank: `<database_name>`
--
CREATE DATABASE IF NOT EXISTS `<database_name>` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `<database_name>`;
```

## Additional information - Shared hosting

If you are not able to create a database using the sql file, which often happens on shared hosting, you can create the database using your hosting provider's control panel.  
Then you would need to remove the following line from the sql file:

```sql
CREATE DATABASE IF NOT EXISTS `<database_name>` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
```

> **Note:**
> You need to use a database using utf8mb4_general_ci encoding.
> Also documents>identifier needs to be Auto-Incremental, will change the example database file to reflect this soon.