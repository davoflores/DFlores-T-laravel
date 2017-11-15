<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class FormularioController extends Controller
{
     public function index(){
        return view('Formulario/index');
     }

     public function procesar(Request $request){
        //variable paraa imprimir el resultado en la vista
        //es un arreglo que cada tres posiciones tiene una fecha, un número y la fecha calculada
        $retorno = [];

        //variable para imprimir la alerta en la vista
        $alerta = "";

        $cantidad = $request->cantidad;

        if($cantidad > 1){
            $valido = true;
            
            //validamos que las fechas sean mayores que la anterior
            $fechaAnterior = date_create($request->fecha_1);
            for ($i=2; $i<=$cantidad; $i++) { 
                $varFecha = 'fecha_'.$i;
                $fecha = date_create($request->$varFecha);
  
                if($fechaAnterior>=$fecha){
                    $alerta = "cada fecha debe ser mayor a la anterior";
                    $valido = false;
                }

                $fechaAnterior = $fecha;
            }

            if($valido) {
                for ($i=1; $i<=$cantidad; $i++) { 
                    $varNumero = 'numero_'.$i;
                    $numero = $request->$varNumero;

                    $varFecha = 'fecha_'.$i;
                    $fecha = date_create($request->$varFecha);

                    $retorno[] = date_format($fecha,"Y/m/d");
                    $retorno[] = $numero;
                    
                    while($numero > 0){
                        date_add($fecha, date_interval_create_from_date_string("1 days"));

                        if($this->isHabil(date_format($fecha, 'd-m-Y'))){
                            $numero--;
                        }
                    }
                    $retorno[] = date_format($fecha,"Y/m/d");
                }
            }
        }
        else {
            $numero = $request->numero_1;
            $fecha = date_create($request->fecha_1);

            $retorno[] = date_format($fecha,"Y/m/d");
            $retorno[] =  $numero;
            
            while($numero > 0){
                date_add($fecha, date_interval_create_from_date_string("1 days"));

                if($this->isHabil(date_format($fecha, 'd-m-Y'))){
                    $numero--;
                }
            }
            $retorno[] =  date_format($fecha,"Y/m/d");
        }

        return view('Formulario/resultado', compact('retorno', 'alerta'));
     }

     private function isHabil($fecha){
        //si el día es sábado o domingo no es hábil
        if(date('N', strtotime($fecha))==6 || date('N', strtotime($fecha))==7) return false;
        else{
            $feriados = [];
            $feriados['01-01-2011']=true;
            $feriados['22-04-2011']=true;
            $feriados['23-04-2011']=true;
            $feriados['01-05-2011']=true;
            $feriados['21-05-2011']=true;
            //$feriados['31-05-2011']=true; (válido solamente en la comuna de Puerto Natales)
            $feriados['27-06-2011']=true;
            $feriados['16-07-2011']=true;
            $feriados['15-08-2011']=true;
            //$feriados['20-08-2011']=true; (válido solamente en las comunas de Chillán y Chillán Viejo)
            $feriados['18-09-2011']=true;
            $feriados['19-09-2011']=true;
            $feriados['10-10-2011']=true;
            $feriados['31-10-2011']=true;
            $feriados['01-11-2011']=true;
            $feriados['08-12-2011']=true;
            //$feriados['11-12-2011']=true; (válido solamente en la comuna de Peñalolén)
            $feriados['25-12-2011']=true;
            $feriados['31-12-2011']=true;

            $feriados['01-01-2012']=true;
            $feriados['06-04-2012']=true;
            $feriados['07-04-2012']=true;
            $feriados['01-05-2012']=true;
            $feriados['21-05-2012']=true;
            $feriados['02-07-2012']=true;
            $feriados['16-07-2012']=true;
            $feriados['15-08-2012']=true;
            //$feriados['20-08-2012']=true; (válido solamente en las comunas de Chillán y Chillán Viejo)
            $feriados['17-09-2012']=true;
            $feriados['18-09-2012']=true;
            $feriados['19-09-2012']=true;
            $feriados['15-10-2012']=true;
            $feriados['28-10-2012']=true;
            $feriados['01-11-2012']=true;
            $feriados['02-11-2012']=true;
            $feriados['08-12-2012']=true;
            $feriados['25-12-2012']=true;
            $feriados['31-12-2012']=true;

            $feriados['01-01-2013']=true;
            $feriados['29-03-2013']=true;
            $feriados['30-03-2013']=true;
            $feriados['01-05-2013']=true;
            $feriados['21-05-2013']=true;
            //$feriados['07-06-2013']=true; (válido solamente en la XV región de Arica y Parinacota)
            $feriados['29-06-2013']=true;
            $feriados['30-06-2013']=true;
            $feriados['16-07-2013']=true;
            $feriados['15-08-2013']=true;
            //$feriados['20-08-2013']=true; (válido solamente en las comunas de Chillán y Chillán Viejo)
            $feriados['18-09-2013']=true;
            $feriados['19-09-2013']=true;
            $feriados['20-09-2013']=true;
            $feriados['12-10-2013']=true;
            $feriados['31-10-2013']=true;
            $feriados['01-11-2013']=true;
            $feriados['17-11-2013']=true;
            $feriados['08-12-2013']=true;
            $feriados['15-12-2013']=true;
            $feriados['25-12-2013']=true;
            $feriados['31-12-2013']=true;

            $feriados['01-01-2014']=true;
            $feriados['18-04-2014']=true;
            $feriados['19-04-2014']=true;
            $feriados['01-05-2014']=true;
            $feriados['21-05-2014']=true;
            //$feriados['07-06-2014']=true; (válido solamente en la XV región de Arica y Parinacota)
            $feriados['29-06-2014']=true;
            $feriados['16-07-2014']=true;
            $feriados['15-08-2014']=true;
            //$feriados['20-08-2014']=true; (válido solamente en las comunas de Chillán y Chillán Viejo)
            //$feriados['08-09-2014']=true; (válido solamente en la II región de Antofagasta)
            $feriados['18-09-2014']=true;
            $feriados['19-09-2014']=true;
            //$feriados['20-09-2014']=true; (válido solamente en la IV región de Coquimbo)
            //$feriados['02-10-2014']=true; (válido solamente en la comuna de Rancagua)
            $feriados['12-10-2014']=true;
            $feriados['31-10-2014']=true;
            $feriados['01-11-2014']=true;
            $feriados['08-12-2014']=true;
            $feriados['25-12-2014']=true;
            $feriados['31-12-2014']=true;

            $feriados['01-01-2015']=true;
            $feriados['03-04-2015']=true;
            $feriados['04-04-2015']=true;
            $feriados['01-05-2015']=true;
            $feriados['21-05-2015']=true;
            //$feriados['07-06-2015']=true; (válido solamente en la XV región de Arica y Parinacota)
            $feriados['29-06-2015']=true;
            $feriados['16-07-2015']=true;
            //$feriados['10-08-2015']=true; (válido solamente en la I región de Tarapacá)
            $feriados['15-08-2015']=true;
            //$feriados['20-08-2015']=true; (válido solamente en las comunas de Chillán y Chillán Viejo)
            $feriados['18-09-2015']=true;
            $feriados['19-09-2015']=true;
            $feriados['12-10-2015']=true;
            $feriados['31-10-2015']=true;
            $feriados['01-11-2015']=true;
            $feriados['08-12-2015']=true;
            $feriados['25-12-2015']=true;
            $feriados['31-12-2015']=true;

            $feriados['01-01-2016']=true;
            $feriados['25-03-2016']=true;
            $feriados['26-03-2016']=true;
            $feriados['01-05-2016']=true;
            $feriados['21-05-2016']=true;
            //$feriados['07-06-2016']=true; (válido solamente en la XV región de Arica y Parinacota)
            //$feriados['19-06-2016']=true; (válido solamente en 93 comunas)
            $feriados['27-06-2016']=true;
            $feriados['16-07-2016']=true;
            //$feriados['10-08-2016']=true; (válido solamente en la I región de Tarapacá)
            $feriados['15-08-2016']=true;
            //$feriados['20-08-2016']=true; (válido solamente en las comunas de Chillán y Chillán Viejo)
            //$feriados['08-09-2016']=true; (válido solamente en la II región de Antofagasta)
            $feriados['18-09-2016']=true;
            $feriados['19-09-2016']=true;
            //$feriados['20-09-2016']=true; (válido solamente en la IV región de Coquimbo)
            $feriados['10-10-2016']=true;
            $feriados['23-10-2016']=true;
            $feriados['31-10-2016']=true;
            $feriados['01-11-2016']=true;
            $feriados['08-12-2016']=true;
            $feriados['25-12-2016']=true;
            $feriados['31-12-2016']=true;

            $feriados['01-01-2017']=true;
            $feriados['02-01-2017']=true;
            $feriados['14-04-2017']=true;
            $feriados['15-04-2017']=true;
            $feriados['19-04-2017']=true;
            $feriados['01-05-2017']=true;
            $feriados['21-05-2017']=true;
            //$feriados['07-06-2017']=true; (válido solamente en la XV región de Arica y Parinacota)
            $feriados['26-06-2017']=true;
            $feriados['02-07-2017']=true;
            $feriados['16-07-2017']=true;
            //$feriados['10-08-2017']=true; (válido solamente en la I región de Tarapacá)
            $feriados['15-08-2017']=true;
            //$feriados['20-08-2017']=true; (válido solamente en las comunas de Chillán y Chillán Viejo)
            $feriados['18-09-2017']=true;
            $feriados['19-09-2017']=true;
            //$feriados['20-09-2017']=true; (válido solamente en la IV región de Coquimbo)
            //$feriados['21-09-2017']=true; (válido solamente en la XII región de Magallanes y Antártica Chilena)
            //$feriados['02-10-2017']=true; (válido solamente en la XIV región de Los Ríos)
            $feriados['09-10-2017']=true;
            $feriados['27-10-2017']=true;
            $feriados['01-11-2017']=true;
            $feriados['19-11-2017']=true;
            $feriados['08-12-2017']=true;
            //$feriados['17-12-2017']=true; (tendrá lugar si se efectúa una segunda vuelta en la elección presidencial)
            $feriados['25-12-2017']=true;

            $feriados['01-01-2018']=true;
            $feriados['30-03-2018']=true;
            $feriados['31-03-2018']=true;
            $feriados['01-05-2018']=true;
            $feriados['21-05-2018']=true;
            //$feriados['07-06-2018']=true; (válido solamente en la XV región de Arica y Parinacota)
            $feriados['02-07-2018']=true;
            $feriados['16-07-2018']=true;
            $feriados['15-08-2018']=true;
            //$feriados['20-08-2018']=true;(válido solamente en las comunas de Chillán y Chillán Viejo)
            $feriados['17-09-2018']=true;
            $feriados['18-09-2018']=true;
            $feriados['19-09-2018']=true;
            $feriados['15-10-2018']=true;
            $feriados['01-11-2018']=true;
            $feriados['02-11-2018']=true;
            $feriados['08-12-2018']=true;
            $feriados['25-12-2018']=true;
            $feriados['31-12-2018']=true;

            $feriados['01-01-2019']=true;
            $feriados['19-04-2019']=true;
            $feriados['20-04-2019']=true;
            $feriados['01-05-2019']=true;
            $feriados['21-05-2019']=true;
            //$feriados['07-06-2019']=true; (válido solamente en la XV región de Arica y Parinacota)
            $feriados['29-06-2019']=true;
            $feriados['16-07-2019']=true;
            $feriados['15-08-2019']=true;
            //$feriados['20-08-2019']=true; (válido solamente en las comunas de Chillán y Chillán Viejo)
            $feriados['18-09-2019']=true;
            $feriados['19-09-2019']=true;
            $feriados['20-09-2019']=true;
            $feriados['12-10-2019']=true;
            $feriados['31-10-2019']=true;
            $feriados['01-11-2019']=true;
            $feriados['08-12-2019']=true;
            $feriados['25-12-2019']=true;
            $feriados['31-12-2019']=true;

            $feriados['01-01-2020']=true;
            $feriados['10-04-2020']=true;
            $feriados['11-04-2020']=true;
            $feriados['01-05-2020']=true;
            $feriados['21-05-2020']=true;
            //$feriados['07-06-2020']=true; (válido solamente en la XV región de Arica y Parinacota)
            $feriados['29-06-2020']=true;
            $feriados['16-07-2020']=true;
            $feriados['15-08-2020']=true;
            //$feriados['20-08-2020']=true; (válido solamente en las comunas de Chillán y Chillán Viejo)
            $feriados['18-09-2020']=true;
            $feriados['19-09-2020']=true;
            $feriados['12-10-2020']=true;
            $feriados['31-10-2020']=true;
            $feriados['01-11-2020']=true;
            $feriados['08-12-2020']=true;
            $feriados['25-12-2020']=true;
            $feriados['31-12-2020']=true;

            if(isset($feriados[$fecha])) return false;
        }
        
        return true;
     }
}
