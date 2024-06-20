<?php

namespace Occasion;

class Navigation {

    public function generate() {
        $html = "";
        $html .= "Occasion site<br>";
        $html .= "<td><a href='index.php?action=aanbod'>Aanbod</a><br></td>";
        $html .= "<td><a href='index.php?action=login'>Inloggen</a><br></td>";
        $html .= "<td><a href='index.php?action=register'>Registreren</a><br></td>";
        $html .= "<td><a href='index.php?action=favorieten'>Favorieten</a><br></td>";
        $html .= "<td><a href='index.php?action=zoeken'>Zoeken</a><br></td>";
        $html .= "<td><a href='index.php?action=logout'>Uitloggen</a><br></td>";
        $html .= "<br><br>";

        return $html;
    }
}

