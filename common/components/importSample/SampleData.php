<?php

namespace common\components\importsample;

use backend\models\Color;
use backend\models\Manufacturer;
use backend\models\Media;
use backend\models\Order;
use backend\models\Vehicle;
use common\components\helpers\StringHelper;
use common\models\User;
use DateTime;
use yii\base\Exception;

class SampleData
{
    /**
     * user data
     * @var array[]
     */
    protected static $userInfoArr = [
        [
            'email' => 'admin@gmail.com',
            'password_hash' => 'Iamadmin@1234',
            'name' => "Admin",
            'tel' => '0364752421',
            'username' => 'admin',
            'role' => User::ROLE_ADMIN,
        ],
        [
            'email' => 'editor@gmail.com',
            'password_hash' => 'Iameditor@1234',
            'name' => "Writer God",
            'tel' => '0334517566',
            'username' => 'editor',
            'role' => User::ROLE_EDITOR,
        ],
        [
            'email' => 'sale@gmail.com',
            'password_hash' => 'Iamsale@1234',
            'name' => "Sale",
            'tel' => '0345678910',
            'username' => 'sale',
            'role' => User::ROLE_SALE,
        ],
        [
            'email' => 'customer@gmail.com',
            'password_hash' => 'Iamcustomer@1234',
            'name' => "Customer",
            'tel' => '0333333333',
            'username' => 'customer',
            'role' => User::ROLE_USER,
        ],
        [
            'email' => 'customer2@gmail.com',
            'password_hash' => 'Iamcustomer2@1234',
            'name' => "Customer2",
            'tel' => '0339583763',
            'username' => 'customer2',
            'role' => User::ROLE_USER,
        ]
    ];

    /**
     *
     * @throws Exception
     */
    private static function insertSampleUser()
    {
        $countUsers = 0;
        foreach (self::$userInfoArr as $values) {
            $user = new User();
            $user->email = $values['email'];
            $user->setPassword($values['password_hash']);
            $user->name = $values['name'];
            $user->tel = $values['tel'];
            $user->generateAuthKey();
            $user->generatePasswordResetToken();
            $user->username = $values['username'];
            $user->referral_code = strstr($values['email'], '@', true);
            $user->role = $values['role'];
            $user->created_at = date('Y-m-d H:m:s');
            $user->updated_at = date('Y-m-d H:m:s');
            if ($user->save()) {
                $countUsers++;
            } else {
                print_r($user->errors);
            }
        }
        echo "Inserted " . $countUsers . '/' . count(self::$userInfoArr) . ' users.' . PHP_EOL;
    }

    protected static $colorArr = [
        [
            'name' => 'Indian Red',
            'color_code' => '#CD5C5C',
        ],
        [
            'name' => 'Light Coral',
            'color_code' => '#F08080',
        ],
        [
            'name' => 'Salmon',
            'color_code' => '#FA8072',
        ],
        [
            'name' => 'Dark Salmon',
            'color_code' => '#E9967A',
        ],
        [
            'name' => 'Light Salmon',
            'color_code' => '#FFA07A',
        ],
        [
            'name' => 'Crimson',
            'color_code' => '#DC143C',
        ],
        [
            'name' => 'Red',
            'color_code' => '#FF0000',
        ],
        [
            'name' => 'Fire Brick',
            'color_code' => '#B22222',
        ],
        [
            'name' => 'Gold',
            'color_code' => '#FFD700',
        ],
        [
            'name' => 'Moccasin',
            'color_code' => '#FFE4B5',
        ],
        [
            'name' => 'Khaki',
            'color_code' => '#F0E68C',
        ],
        [
            'name' => 'Lavender',
            'color_code' => '#E6E6FA',
        ],
        [
            'name' => 'Plum',
            'color_code' => '#DDA0DD',
        ],
        [
            'name' => 'Violet',
            'color_code' => '#EE82EE',
        ],
        [
            'name' => 'Orchid',
            'color_code' => '#DA70D6',
        ],
        [
            'name' => 'Magenta',
            'color_code' => '#FF00FF',
        ],
        [
            'name' => 'Blue Violet',
            'color_code' => '#8A2BE2',
        ],
        [
            'name' => 'Spring Green',
            'color_code' => '#00FF7F',
        ],
        [
            'name' => 'Turquoise',
            'color_code' => '#40E0D0',
        ],
    ];

    private static function insertSampleColor()
    {
        $countColor = 0;
        foreach (self::$colorArr as $values) {
            $color = new Color();
            $color->name = $values['name'];
            $color->color_code = $values['color_code'];
            $color->created_at = date('Y-m-d H:m:s');
            $color->updated_at = date('Y-m-d H:m:s');
            if ($color->save()) {
                $countColor++;
            } else {
                print_r($color->errors);
            }
        }
        echo "Inserted " . $countColor . '/' . count(self::$colorArr) . ' colors.' . PHP_EOL;
    }

    protected static $manufacturerArr = [
        [
            'name' => 'Toyota',
            'address' => 'South Korea',
        ],
        [
            'name' => 'Stellantis',
            'address' => 'Netherlands',
        ],
        [
            'name' => 'SAIC Motor',
            'address' => 'Shanghai, China',
        ],
        [
            'name' => 'BMW Group',
            'address' => 'Germany',
        ],
        [
            'name' => 'Honda Motor',
            'address' => 'Japan',
        ],
        [
            'name' => 'Ford Motor',
            'address' => 'USA',
        ],
        [
            'name' => 'Daimler',
            'address' => 'Germany',
        ],
        [
            'name' => 'Volkswagen Group',
            'address' => 'Germany',
        ],
    ];

    private static function insertSampleManufacturer()
    {
        $countManufacturer = 0;
        foreach (self::$manufacturerArr as $values) {
            $manufacturer = new Manufacturer();
            $manufacturer->name = $values['name'];
            $manufacturer->slug = StringHelper::toSlug($values['name']);
            $manufacturer->address = $values['address'];
            $manufacturer->created_at = date('Y-m-d H:m:s');
            $manufacturer->updated_at = date('Y-m-d H:m:s');
            if ($manufacturer->save()) {
                $countManufacturer++;
            } else {
                print_r($manufacturer->errors);
            }
        }
        echo "Inserted " . $countManufacturer . '/' . count(self::$manufacturerArr) . ' manufacturers.' . PHP_EOL;
    }

    protected static $mediaArr = [
        [
            'link' => 'media/images/vehicle.jpg',
            'extension' => 'jpg',
        ],
    ];

    private static function insertSampleMedia()
    {
        $countMedia = 0;
        foreach (self::$mediaArr as $values) {
            $media = new Media();
            $media->link = $values['link'];
            $media->extension = $values['extension'];
            $media->created_at = date('Y-m-d H:m:s');
            $media->updated_at = date('Y-m-d H:m:s');
            if ($media->save()) {
                $countMedia++;
            } else {
                print_r($media->errors);
            }
        }
        echo "Inserted " . $countMedia . '/' . count(self::$mediaArr) . ' media.' . PHP_EOL;
    }

    protected static $vehicleArr = [
        [
            'SKU' => 'FMMEN-2022',
            'name' => '2022 Ford Mustang Mach-E: Nominee',
            'image_id' => 1,
            'image_related' => '1,1,1,1',
            'manufacturer' => 6,
            'model' => 'Nominee',
            'series' => '2022 series',
            'color' => 9,
            'engine_number' => '52WCV20234',
            'fuel_capacity' => 105,
            'manufacture_date' => '04/2022',
            'original_price' => 50230,
            'selling_price' => 55473,
            'discount' => 0,
            'total_quantity' => 50,
        ],
        [
            'SKU' => 'BMWS-2023',
            'name' => 'BMW 2',
            'image_id' => 1,
            'image_related' => '1,1,1,1',
            'manufacturer' => 4,
            'model' => '228i sDrive',
            'series' => '2023 2 Series Gran Coupe',
            'color' => 8,
            'engine_number' => '24BMV12345',
            'fuel_capacity' => 220,
            'manufacture_date' => '09/2022',
            'original_price' => 32100,
            'selling_price' => 36600,
            'discount' => 0,
            'total_quantity' => 30,
        ],
        [
            'SKU' => 'HDAH-2022',
            'name' => '2022 Avalon Hybrid',
            'image_id' => 1,
            'image_related' => '1,1,1,1',
            'manufacturer' => 5,
            'model' => 'Hybrid series',
            'series' => '2022 series',
            'color' => 5,
            'engine_number' => '18HDS22345',
            'fuel_capacity' => 240,
            'manufacture_date' => '01/2022',
            'original_price' => 32100,
            'selling_price' => 37850,
            'discount' => 0,
            'total_quantity' => 15,
        ],
        [
            'SKU' => 'VWT-2021',
            'name' => '2021 Volkswagen Tiguan 2.0T SE R-Line Black            ',
            'image_id' => 1,
            'image_related' => '1,1,1,1',
            'manufacturer' => 8,
            'model' => 'Tiguan 2.0T',
            'series' => '2021 series',
            'color' => 14,
            'engine_number' => '23WCV14324',
            'fuel_capacity' => 105,
            'manufacture_date' => '04/2021',
            'original_price' => 30150,
            'selling_price' => 36250,
            'discount' => 0,
            'total_quantity' => 24,
        ],
        [
            'SKU' => 'VWGGA-2017',
            'name' => '2017 Volkswagen Golf GTI Autobahn 4-Door',
            'image_id' => 1,
            'image_related' => '1,1,1,1',
            'manufacturer' => 8,
            'model' => 'Golf GTI',
            'series' => '2017 series',
            'color' => 6,
            'engine_number' => '21WCV14245',
            'fuel_capacity' => 152,
            'manufacture_date' => '03/2017',
            'original_price' => 20980,
            'selling_price' => 32550,
            'discount' => 0,
            'total_quantity' => 44,
        ],
    ];

    private static function insertSampleVehicle()
    {
        $countVehicle = 0;
        foreach (self::$vehicleArr as $values) {
            $vehicle = new Vehicle();
            $vehicle->SKU = $values['SKU'];
            $vehicle->name = $values['name'];
            $vehicle->image_id = $values['image_id'];
            $vehicle->image_related = $values['image_related'];
            $vehicle->manufacturer = $values['manufacturer'];
            $vehicle->model = $values['model'];
            $vehicle->series = $values['series'];
            $vehicle->color = $values['color'];
            $vehicle->engine_number = $values['engine_number'];
            $vehicle->fuel_capacity = $values['fuel_capacity'];
            $vehicle->manufacture_date = $values['manufacture_date'];
            $vehicle->original_price = $values['original_price'];
            $vehicle->selling_price = $values['selling_price'];
            $vehicle->discount = $values['discount'];
            $vehicle->total_quantity = $values['total_quantity'];
            $vehicle->created_at = date('Y-m-d H:m:s');
            $vehicle->updated_at = date('Y-m-d H:m:s');
            if ($vehicle->save()) {
                $countVehicle++;
            } else {
                print_r($vehicle->errors);
            }
        }
        echo "Inserted " . $countVehicle . '/' . count(self::$vehicleArr) . ' vehicles.' . PHP_EOL;
    }

    protected static $orderArr = [
        [
            'customer_id' => 3,
            'vehicle_id' => 2,
            'quantity' => 2,
            'ship_method' => 2,
            'ship_fee' => 0,
            'created_by' => 2,
            'total_price' => 73200
        ],
        [
            'customer_id' => 4,
            'vehicle_id' => 1,
            'quantity' => 5,
            'ship_method' => 1,
            'ship_fee' => 0,
            'created_by' => 3,
            'total_price' => 277365
        ],
    ];

    private static function insertSampleOrder()
    {
        $countOrder = 0;
        foreach (self::$orderArr as $values) {
            $order = new Order();
            $order->uuid = StringHelper::genUuid();
            $order->customer_id = $values['customer_id'];
            $order->vehicle_id = $values['vehicle_id'];
            $order->quantity = $values['quantity'];
            $order->ship_method = $values['ship_method'];
            $order->ship_date = (new DateTime('+2 day'))->format('Y-m-d H:i:s');
            $order->ship_fee = $values['ship_fee'];
            $order->created_by = $values['created_by'];
            $order->created_at = date('Y-m-d H:m:s');
            $order->updated_at = date('Y-m-d H:m:s');
            if ($order->save()) {
                $countOrder++;
            } else {
                print_r($order->errors);
            }
        }
        echo "Inserted " . $countOrder . '/' . count(self::$orderArr) . ' orders.' . PHP_EOL;
    }

    /**
     * @throws Exception
     */
    public static function importAllSampleData()
    {
        self::insertSampleUser();
        self::insertSampleColor();
        self::insertSampleManufacturer();
        self::insertSampleMedia();
        self::insertSampleVehicle();
        self::insertSampleOrder();
    }
}
