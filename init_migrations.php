#!/usr/bin/env php
<?php
echo "\n  Start initialization ...\n\n";
exec("php yii migrate --migrationPath=@yii/rbac/migrations --interactive=0");
exec("php yii migrate --interactive=0");
exec("php yii rbac/gen --interactive=0");
exec("php yii rbac/set-all-roles-to-user --interactive=0");
echo "\n  ... initialization completed.\n\n";
exit(0);