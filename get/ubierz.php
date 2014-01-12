<?php
        
function ubierz($a, $classname, $link) {
        //$temp = 1;
        //print "dupa:".$a;
		//Var_dump($a)
        //return 0;
        $data = $a->fetchAll( PDO::FETCH_BOTH );        
        $out = '<div class="'.$classname.'"><table>';
        foreach ($data as $row){
                //jeśli mamy id to potraktuj specjalnie
                if(!isset($row['id'])) $temp=0; else $temp=$row['id'];
                
                $out .= '<tr><td><a href="index.php?'.$link.'='.$temp.'" >:::&gt; </a></td>';
                foreach ($row as $key => $value) {
                        if(! is_int( $key) && $key !='id' )
                        $out .= '<td><b>'.$key.'</b>: '.$value.' </td>';
                }
                $out .= '</td><td>[<a href="index.php?del_'.$link.'='.$temp.'" >x</a>]</td></tr>';
        }
        $out.= '</table></div>'; 
        return $out;
};

function ubierz_dlugi($a, $classname, $link) {
        //$temp = 1;
        $data = $a->fetchAll( PDO::FETCH_BOTH );        
        $out = '<div class="'.$classname.'">';
        foreach ($data as $row){
                if(!isset($row['id'])) $temp=0; else $temp=$row['id'];
                $out .= '<table>';
                foreach ($row as $key => $value) {
                        if(! is_int( $key) && $key !='id' )
                        $out .= '<tr><td><b>'.$key.'</b></td><td>'.$value.'</td> </tr>';
                        
                }             
                $out .= '</table>';
                $out .= '[<a href="index.php?add_'.$link.'='.$temp.'" >edytuj</a>]';
        }
        $out.= '</div>'; 
        return $out;
        //<td><a href="index.php?'.$link.'='.$temp.'" >:::&gt</a></td>
};

//niestety nie wszystko działało jak należy i troszkę łopatologicznie dodana nowa funkcja
function ubierz_funkcje_ekipa_kurs($a, $classname, $link, $id_ekipa) {
        //$temp = 1;
        $data = $a->fetchAll( PDO::FETCH_BOTH );        
        $out = '<div class="'.$classname.'"><table>';
        foreach ($data as $row){
                //jeśli mamy id to potraktuj specjalnie
                if(!isset($row['id'])) $temp=0; else $temp=$row['id'];
                
                $out .= '<tr><td><a href="index.php?'.$link.'='.$temp.'" >:::&gt; </a></td>';
                foreach ($row as $key => $value) {
                        if(! is_int( $key) && $key !='id' )
                        $out .= '<td>'.$key.': '.$value.' </td>';
                }
                $out .= '</td><td>[<a href="index.php?del_'.$link.'&idKursy='.$row['id_kursy'].'&idEkipa='.$id_ekipa.'&idFunkcje='.$temp.'" >x</a>]</td></tr>';
        }
        $out.= '</table></div>'; 
        return $out;
};

?>
