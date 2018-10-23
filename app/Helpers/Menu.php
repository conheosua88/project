<?php 
namespace App\Helpers;
class Menu {
    public static function menu($data,$parent = 0,$str = "-",$select = 0){
        foreach ($data as  $value) {
            $id = $value["id"];
            $name = $value["name"];
            if($value["parent_category_id"] == $parent){
                if($select != 0 && $id == $select){
                    echo "<option value='$id' selected='selected'>$str $name</option>";
                }else{
                    echo "<option value='$id'>$str $name </option>";
                }
                Menu::menu($data,$id, $str."-",$select);
            }
        }
    }
    public static function formatCurrency($n, $separate = "."){
         $len = strlen($n);
         $ret = "";
        for( $i = 1; $i <= $len; $i++) {
          $ret = $n[($len - $i)] . $ret;
          if( $i % 3  === 0 && $i < $len) {
            $ret = $separate . $ret;
          }
        }
        return $ret;
      }

}
?>