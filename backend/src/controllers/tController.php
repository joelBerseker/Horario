<?php

namespace User\Backend\controllers;

use User\Backend\lib\Controller;
use User\Backend\models\Tabl;

class tController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function tindex()
    {
        //acl true
        $r = Tabl::getAll();
        $this->render('Tabl/home', ['op' => 0, 'response' => 1, 'message' => 'success', 'Tabl' => $r]);
    }
    public function addT($data)
    {
        $TabID = $data['id'];
        if (!is_null($TabID)) {
            $r = new Tabl($TabID);
            $r->save();
            $this->render('Tabl/home', ['op' => 1, 'response' => 1, 'message' => 'add successfuly']);
        } else {
            echo "error";
        }
    }
    public function editT($data, $id)
    {
        $TabEst = $data['reserved'];
        $TabFecHour = $data['hour'];
        $TabEstReg = $data['state'];
        if (!is_null($id) && !is_null($TabEst) && !is_null($TabEstReg)) {
            $r = Tabl::getByIds($id);
            $r->setTabEst($TabEst);
            $r->setTabEstReg($TabEstReg);
            if(!is_null($TabFecHour)){
                $r->setTabFecHour($TabFecHour);
            }
            //colocar if si existe recien se cambia, fecha no obligatoria if reserved = 3
            //se deberia agregar tabla reservas que tenga numero de mesa, cliente que reserva y la hora
            $r->update();
            $this->render('Tabl/home', ['op' => 3, 'response' => 1, 'message' => 'update successfuly', 'tabl' => $r->toArray()]);
        } else {
            echo "Error";
        }
    }

    public function viewT($data)
    {
        $r = Tabl::getById($data);
        $this->render('Tabl/home', ['op' => 2, 'response' => 1, 'message' => 'success', 'tabl' => $r]);
    }
    public function deleteT($data)
    {
        $r = Tabl::delete($data);
        $this->render('Tabl/home', ['op' => 4, 'response' => 1, 'message' => 'delete success']);
    }
}
