<?php

namespace App\Controllers\API;
use App\Models\EstudianteModel;
use CodeIgniter\RESTful\ResourceController;
class Estudiantes extends ResourceController
{
    //SETEANDO MODELO
    public function __construct(){ 
    $this->model=$this->setModel(new EstudianteModel());
    }
//FUNCION PARA MOSTRAR TODOS LOS REGISTROS
    public function index()
    {
        $estudiante=$this->model->findAll();
        return $this->respond($estudiante);
    } 

    //FUNCION PARA CREAR REGISTRO
    public function create()
    {
        try{
            //model:DEFINIDO EN EstudianteModel
            //TODO EL CUERPO DE FORMATO JSON, SE INSTANCIARÁ EN LA VAR. ESTUDIANTE PARA CREAR EL OBJ
            $estudiante=$this->request->getJSON();
            if($this->model->insert($estudiante))://METODO BOOLEANO: TRUE SI SE CUMPLE
                //PARA DEVOLVER ID
                $estudiante->id=$this->model->insertID();
                return $this->respondCreated($estudiante);//RESPUESTA QUE VALIDA CREACION DE RECUERSO  EN API
            else:
                return $this->failValidationError($this->model->validation->listErrors());
            endif;

        } catch(\Exception $e){
            return $this->failServerError('Error en el servidor');
        }
        
    }
    //LISTAR OBJETOS EN ESPECÍFICO
    public function show($id = null)
	{
		try{
           if($id==null)
           return $this->failValidationError('Ingrese un id válido.');
           $estudiante=$this->model->find($id);
           if($estudiante==null)
           return $this->failNotFound('Estudiante no encontrado.');
           return $this->respond($estudiante);
        } catch(\Exception $e){
            return $this->failServerError('Error en el servidor.');
        }
	}

    //FUNCION PARA ACTUALIZAR
    public function update($id = null)
	{
		try{
           if($id==null)
           return $this->failValidationError('Ingrese un id válido.');
           $estudianteVerificado=$this->model->find($id);
           if($estudianteVerificado==null)
           return $this->failNotFound('Estudiante no encontrado.');

           $estudiante=$this->request->getJSON();
      
           if($this->model->update($id,$estudiante))://METODO BOOLEANO: TRUE SI SE CUMPLE
            //PARA DEVOLVER ID
            $estudiante->id=$id;
            return $this->respondUpdated($estudiante);//RESPUESTA QUE VALIDA CREACION DE RECUERSO  EN API
            else:
            return $this->failValidationError($this->model->validation->listErrors());
        endif;
          
        } catch(\Exception $e){
            return $this->failServerError('Error en el servidor.');
        }
	}
//FUNCION PARA ELIMINAR
	public function delete($id = null)
	{
		try{
            if($id==null)
            return $this->failValidationError('Ingrese un id válido.');
            $estudianteVerificado=$this->model->find($id);
            if($estudianteVerificado==null)
            return $this->failNotFound('Estudiante no encontrado.');
 
         if($this->model->delete($id))://METODO BOOLEANO: TRUE SI SE CUMPLE
             //PARA DEVOLVER ID
      //       $cliente->id=$id;
             return $this->respondDeleted($estudianteVerificado);//RESPUESTA QUE VALIDA CREACION DE RECUERSO  EN API
             else:
             return $this->failServerError('El estudiante no ha podido eliminarse.');
         endif;
           
         } catch(\Exception $e){
             return $this->failServerError('Error en el servidor.');
         }
	}


}
