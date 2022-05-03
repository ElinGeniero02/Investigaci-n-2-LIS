<?php namespace App\Models;

use CodeIgniter\Model;

//HEREDANDO CLASE MODEL PARA LA CLASE CLIENTE
class EstudianteModel extends Model
{
    protected $table ='estudiantes';
    protected $primaryKey ='IdEstudiante';
//DEVOLVIENDO RESULTADOS DEL MAPEO DE LA TABLA
//LOS RESULTADOS SE DEVUELVEN COMO ARREGLO
    protected $returnType ='array';
    //COLUMNAS DE LA TABLA
    protected $allowedFields=['Nombres', 'Apellidos','Carnet','Carrera','Correo','Telefono'];
    //VALIDACION DEL MODELO
    //REGLAS A CUMPLIR DE ACUERDO AL TIPO DE CAMPO
    protected $validationRules=[
        //SOLO PERMITE CARACTERES Y ESPACIO MÁXIMO Y MINIMO ADMITIDO
        'Nombres'=>'required|alpha_space|min_length[10]|max_length[500]',
        'Apellidos'=>'required|alpha_space|min_length[10]|max_length[500]',
        'Carnet'=>'required|max_length[8]',
        'Carrera'=>'required|max_length[3]',
        'Correo'=>'required|valid_email|max_length[500]',
        'Telefono'=>'required|alpha_numeric_space|min_length[8]|max_length[8]',
        
    ];
//MENSAJE PARA VALIDAR REGLAS
protected $validationMessages=[
    'Correo' =>[
        'valid_email'=>'Debes ingresar un email válido'
    ]
    ];
    protected $skipValidation=false;
}