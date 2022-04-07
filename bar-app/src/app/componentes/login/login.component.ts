import { Component, OnInit } from '@angular/core';
import { UsuarioService } from '../../sevicios/usuario.service';
import { Usuario } from '../../modelos/usuario';
import { GlobalConstants } from 'src/app/common/global';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  public accion:any;
public usuario:Usuario;
public identificado:any;
  constructor(private servicio:UsuarioService) {
    this.usuario=new Usuario("","")
    if(this.identificado==null){
      this.identificado=false;
    }
   }

  ngOnInit(): void {
    if(  GlobalConstants.identificadoglobal=="false"){
      this.identificado=false;  

    }
  }
  login(form:any){
    this.accion="login";
this.servicio.login(this.usuario.usuario,this.usuario.password,this.accion).subscribe(
  result=>{
if(result.identity!="false"){
  GlobalConstants.identificadoglobal=result.identity
  GlobalConstants.estadocaja=result.estadocaja
  GlobalConstants.mesas=result.mesas
  GlobalConstants.mozos=result.mozos
  this.identificado=GlobalConstants.identificadoglobal;  


}
else{
  GlobalConstants.identificadoglobal="false";  
}
  },
  error=>{
    console.log(error)
  }
)
form.reset()

}
cerrarsesion(){
  this.accion="logout";
  let cerrar=confirm("¿Esta seguro de cerrar sesión?")
  if(cerrar==true){
  this.servicio.logout(this.identificado.nombre,this.accion).subscribe(
    result=>{
      GlobalConstants.identificadoglobal="false";  
      this.identificado=false
    },
    error=>{
      console.log(error)
    }
  )
window.location.href="http:localhost:4200/login"
}
  
  }
}



