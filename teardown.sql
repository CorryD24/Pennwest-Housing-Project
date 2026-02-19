-- Step 1: Revoke all privileges from non-admin users
REVOKE ALL PRIVILEGES ON housing_waitlist.* FROM 'your_user'@'localhost';

-- Step 2: Drop unnecessary users (optional, if you want to remove application-specific users)
DROP USER 'your_user'@'localhost';

-- Step 3: Terminate active connections to the database
SELECT CONCAT('KILL ', id, ';') AS cmd FROM information_schema.processlist WHERE db = 'housing_waitlist';

-- Step 4: Disable foreign key checks to prevent constraint errors (optional)
SET FOREIGN_KEY_CHECKS = 0;

-- Step 5: Remove stored procedures, triggers, events, or views (if applicable)
DROP PROCEDURE IF EXISTS some_procedure;
DROP TRIGGER IF EXISTS some_trigger;
DROP EVENT IF EXISTS some_event;
DROP VIEW IF EXISTS some_view;

-- Step 6: Restore foreign key checks (if disabled earlier)
SET FOREIGN_KEY_CHECKS = 1;

-- Step 7: Remove database-specific grants (optional, if you want to prevent access entirely)
DELETE FROM mysql.db WHERE Db = 'housing_waitlist';

-- Step 8: Flush privileges to apply changes
FLUSH PRIVILEGES;
