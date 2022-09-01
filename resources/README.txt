git clone https://github.com/CtrlShiftN/yii2-starter-kit.git

php init

composer install

composer require yiisoft/yii2-bootstrap5
(Inside assets/AppAsset.php, 'yii\bootstrap4\BootstrapAsset' => 'yii\bootstrap5\BootstrapAsset')

composer require rmrevin/yii2-fontawesome
(Inside assets/AppAsset.php, add '\rmrevin\yii\fontawesome\AssetBundle' to $depend)

php yii seeder

