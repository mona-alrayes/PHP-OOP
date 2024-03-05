<?php
session_start();

//validate functions needed 
trait func{
    function cleanData($data)
    {
        $data = htmlspecialchars($data);
        $data = trim($data);
        $data = strip_tags($data);
        $data = stripslashes($data);
        return $data;
    }
    function isYear($number) {
        if (is_numeric($number) && strlen($number) === 4 && $number >= 1950 && $number <= 2024) {
            return true;
        } else {
            return false;
        }
    }
    function validPrice($number) {
        if(!is_numeric($number) || $number <=1000000){
            return true;
          }
           else {
            return false;
          }
         }
}

// end of validate functions 

// classes Car , InfoPrint , Validator 

class Car{
    protected $company;
    protected $model;
    protected $year;
    protected $price;
}
class InfoPrint extends Car
{
    public function __construct($company, $model, $year, $price)
    {
        $this->company = $company;
        $this->model = $model;
        $this->year = $year;
        $this->price = $price;
    }
    public function print()
    {
        echo '<span><h2>الشركة المصنعة ' . $this->company . '</h2></span><br>';
        echo '<span><h2> الموديل ' . $this->model . '</h2></span><br>';
        echo '<span><h2> سنة التصنيع ' . $this->year . '</h2></span><br>';
        echo '<span><h2> السعر ' . $this->price . ' SY</h2></span><br>';
        echo '<span><h3>Welcome to Oject Oriented programming OOP</h3></span>';
    }
}
class Validator extends Car
{
    private $error = array();
    private $Found = false;
    private $Found2 = false;
    private $car_models = [
        'ACURA' => ['NSX', 'MDX', 'RDX', 'TLX'],
        'ALFA ROMEO' => ['Giulia', 'Stelvio', '4C', 'Giulietta'],
        'ASTON MARTIN' => ['DB11', 'Vantage', 'DBS Superleggera', 'Rapide'],
        'AUDI' => ['A4', 'A6', 'Q5', 'Q7'],
        'BENTLEY' => ['Continental GT', 'Bentayga', 'Flying Spur', 'Mulsanne'],
        'BMW' => ['3 Series', '5 Series', 'X5', '7 Series'],
        'BUGATTI' => ['Chiron', 'Veyron', 'Divo', 'EB110'],
        'BUICK' => ['Enclave', 'Encore', 'Regal', 'LaCrosse'],
        'CADILLAC' => ['Escalade', 'CTS', 'XT5', 'CT6'],
        'CHEVROLET' => ['Silverado', 'Camaro', 'Equinox', 'Tahoe'],
        'CHRYSLER' => ['300', 'Pacifica'],
        'CITROËN' => ['C3', 'C4 Picasso', 'C5 Aircross'],
        'DODGE' => ['Challenger', 'Charger', 'Durango'],
        'FERRARI' => ['488 GTB', '812 Superfast', 'Portofino'],
        'FIAT' => ['500', 'Panda', 'Tipo'],
        'FORD' => ['F-150', 'Mustang', 'Explorer', 'Escape'],
        'GENESIS' => ['G70', 'G80', 'G90'],
        'GMC' => ['Sierra 1500', 'Terrain', 'Acadia'],
        'HONDA' => ['Accord', 'Civic', 'CR-V', 'Pilot'],
        'HYUNDAI' => ['Elantra', 'Santa Fe', 'Tucson', 'Palisade'],
        'INFINITI' => ['Q50', 'QX60', 'QX80'],
        'JAGUAR' => ['F-Type', 'XE', 'F-Pace', 'I-Pace'],
        'JEEP' => ['Wrangler', 'Grand Cherokee', 'Cherokee', 'Renegade'],
        'KIA' => ['Optima', 'Sportage', 'Sorento', 'Telluride', 'Cerato'],
        'LAMBORGHINI' => ['Aventador', 'Huracán', 'Urus'],
        'LAND ROVER' => ['Range Rover', 'Discovery', 'Defender'],
        'LEXUS' => ['RX', 'ES', 'NX', 'LS'],
        'LINCOLN' => ['Navigator', 'Aviator', 'Corsair'],
        'MASERATI' => ['Ghibli', 'Levante', 'Quattroporte'],
        'MAZDA' => ['Mazda3', 'CX-5', 'Mazda6'],
        'MCLAREN' => ['720S', '570S', '675LT'],
        'MERCEDES-BENZ' => ['C-Class', 'E-Class', 'S-Class', 'GLC'],
        'MINI' => ['Cooper', 'Countryman', 'Clubman'],
        'MITSUBISHI' => ['Outlander', 'Eclipse Cross', 'Pajero'],
        'NISSAN' => ['Altima', 'Rogue', 'Sentra', 'Pathfinder'],
        'PAGANI' => ['Huayra', 'Zonda'],
        'PEUGEOT' => ['208', '3008', '508'],
        'PORSCHE' => ['911', 'Cayenne', 'Panamera', 'Macan'],
        'RAM' => ['1500', '2500', '3500'],
        'RENAULT' => ['Clio', 'Megane', 'Captur'],
        'ROLLS-ROYCE' => ['Phantom', 'Ghost', 'Cullinan'],
        'SUBARU' => ['Outback', 'Forester', 'Impreza', 'Crosstrek'],
        'SUZUKI' => ['Swift', 'Vitara', 'Jimny'],
        'TESLA' => ['Model S', 'Model 3', 'Model X', 'Model Y'],
        'TOYOTA' => ['Camry', 'Corolla', 'RAV4', 'Highlander'],
        'VOLKSWAGEN' => ['Golf', 'Passat', 'Tiguan', 'Atlas'],
        'VOLVO' => ['XC90', 'XC60', 'S60', 'V60']
    ];
    use func;
 // this method check if there are errors in the input form 
    public function CheckErrors($POST)
    {
        foreach ($POST as $key => $value) {
            if ($key == 'company') {
                if (trim($value) == '') {
                    $this->error[] = "الرجاء ادخال اسم الشركة ";
                } else {
                    $inputCompany = $this->cleanData(strtoupper($value));
                    if (!array_key_exists($inputCompany, $this->car_models)) {
                        $this->error[] = 'اسم الشركة غير موجود في بياناتنا اكتب اسم شركة معروفة';
                    } else {
                        $this->company = $inputCompany;
                    }
                }
            } elseif ($key == 'model') {
                if (trim($value) == '') {
                    $this->error[] = "الرجاء ادخال موديل السيارة";
                } elseif (!empty($this->company)) {
                    $inputModel = $this->cleanData(strtoupper($value));
                    if (!in_array($inputModel, array_map('strtoupper', $this->car_models[$this->company]))) {
                        $this->error[] = 'موديل السيارة غير موجود لهذه الشركة. يرجى إدخال موديل صحيح.';
                    } else {
                        $this->model = $inputModel;
                    }
                }
            } elseif ($key == 'year') {
                if (trim($value) == '') {
                    $this->error[] = "الرجاء ادخال سنة التصنيع";
                }elseif(!$this->isyear($value)){
                    $this->error[] = "الرجاء ادخال صيغة عام صحيحة ولا يكون التاريخ اقدم من 1950 او اكثر من التاريخ الحالي ";
                } 
                else {
                    $this->year = $this->cleanData($value);
                }
            } elseif ($key == 'price') {
                if (trim($value) == '') {
                    $this->error[] = "الرجاء ادخال سعر السيارة";
                }elseif($this->validPrice($value)){
                    $this->error[] = "لم تدخل سعر او ادخلت سعرا اقل من مليون ";
                } 
                else {
                    $this->price = $this->cleanData($value);
                }
            }
        }
  // if there is no error , then it creates object of class InfoPrint and pass the information of the form through the constractor 
  // then send this object in session global variable to the display_car.php
  // not that I opened a session in the beginning of the page 
        if (count($this->error) == 0) {
            $car1 = new InfoPrint($this->company, $this->model, $this->year, $this->price);
            // Store Car object in session or pass it as a query parameter
            $_SESSION['car_object'] = $car1;
            // Redirect to another PHP file
            header("Location: display_car.php");
            exit();
        }

        return $this->error;
    }
}
