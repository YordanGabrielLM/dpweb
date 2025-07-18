<?php
class viewModel
{
    protected static function get_view($view)
    {
       $white_list = ["home","products","users","new-user","categoria"];
       if (in_array($view,$white_list)) {
            if (is_file("./views/".$view.".php")) {
            $content = "./views/".$view.".php";
            }else {
                 $content = "404";
            }
        }elseif ($view == "login") {
            $content = "login";
         }else {
            $content = "404";
       }
       return $content;
    }
}

