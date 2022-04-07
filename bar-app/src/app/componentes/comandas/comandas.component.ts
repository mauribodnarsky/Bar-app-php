import { Component, OnInit } from '@angular/core';
import { GlobalConstants } from 'src/app/common/global';
import { Mesaseleccionada} from '../../modelos/mesaseleccionada';
import { ComandasService } from '../../servicios/comandas.service';
import { Busqueda } from '../../modelos/busqueda';
import { THIS_EXPR } from '@angular/compiler/src/output/output_ast';
@Component({
  selector: 'app-comandas',
  templateUrl: './comandas.component.html',
  styleUrls: ['./comandas.component.css']
})
export class ComandasComponent implements OnInit {
  public identificado:boolean;
  public estadocaja:string;
  public mozos:any;
  public ticket:any;
  public mesas:any;
public accion:any;
public factura:any;
  public mesaseleccionada:string;
  public mesamodelo: Mesaseleccionada;
  public productos_busqueda: any;
  public busqueda:Busqueda;
  constructor(private servicio:ComandasService) { 
    this.productos_busqueda='';
    this.factura=false;
    this.busqueda=new Busqueda("",0);
    this.mesamodelo=new Mesaseleccionada("",false,"",1)
    this.mesaseleccionada='';
    if(GlobalConstants.identificadoglobal=="false"){
      this.identificado=false;
      this.estadocaja="false"
      this.mesas="false"
      this.mozos=GlobalConstants.mozos

    }else{
      this.identificado=true;
      this.estadocaja=GlobalConstants.estadocaja
      this.mesas=GlobalConstants.mesas
      this.mozos=GlobalConstants.mozos

    }  
  }

  ngOnInit(): void {
    if(GlobalConstants.identificadoglobal=="false"){
      this.identificado=false;
      this.estadocaja="false"
      this.mesas="false"

    }else{
      this.identificado=true;
      
    this.estadocaja=GlobalConstants.estadocaja
      this.mesas=GlobalConstants.mesas
      this.servicio.buscarproducto(this.busqueda.busqueda,"buscarproducto").subscribe(
        result=>{
          this.productos_busqueda=result;
        },
        error=>{
          alert(error)
        }
      )
    }  

  }
  seleccionarmesa(mesa:any){
    console.log(this.mesamodelo.mozo)

    this.mesamodelo=mesa;
    this.mesaseleccionada=this.mesamodelo.numero_mesa  ; 
    console.log("mesa modelo")
    console.log(this.mesamodelo)
    if(this.mesamodelo.estado==1){
      this.factura=false  
  }
  if(this.mesamodelo.estado==0){

    this.servicio.seleccionarmesa(this.mesaseleccionada,"seleccionarmesa").subscribe(
      result=>{
     
        
        this.mesas=result.mesas;
        this.factura=result.factura;

console.log(this.factura)
                },
      error=>{
      }
    )}
  }
  
cerrarmesa(form:any){
  this.mesamodelo=form
  this.accion="cerrarmesa";
console.log(this.mesaseleccionada)
  this.servicio.cerrarmesa(this.mesaseleccionada,this.accion).subscribe(
    result=>{
      this.mesas=result.mesas;
      alert("MESA NUMERO "+this.mesaseleccionada+" CERRADA CORRECTAMENTE")
    form.reset()
    
    this.mesas=result.mesas;
    this.ticket=result.ticket
    this.factura=null
    },
    error=>{
      alert("MESA NUMERO "+this.mesaseleccionada+"  NO PUDO CERRARSE CORRECTAMENTE")
      console.log(error)

    }
  )
  
}
agregarproducto(form:any){


  let codigo=this.busqueda.busqueda;
  let cantidad=this.busqueda.cantidad.toString() ;
 this.accion="AgregarProducto";
  this.servicio.agregarproducto(codigo,cantidad,this.accion,this.mesamodelo.numero_mesa).subscribe(
    result=>{
    this.mesas=result.mesas;
    this.factura=result.factura;
    this.mesaseleccionada=this.mesamodelo.numero_mesa  ; 
  
   },
    error=>{
      console.log(error)
    }

    )
  

}
seleccionarcodigo(codigo:any){
this.busqueda.busqueda=codigo;
}
buscarproducto(texto:any){
  this.servicio.buscarproducto(texto,"buscarproducto").subscribe(
    result=>{
      this.productos_busqueda=result;

    },
    error=>{
    }
  )
}

abrirmesa(form:any){
  if(this.mesamodelo.mozo==undefined){
    alert("Selecciona un mozo para continuar")}
  else if(this.mesamodelo.mozo!=undefined){
  this.accion="abrirmesa";

  this.servicio.abrirmesa(this.mesamodelo.numero_mesa,this.mesamodelo.mozo,this.accion).subscribe(
    result=>{
      this.mesas='false';
      alert("MESA NUMERO "+this.mesamodelo.numero_mesa+" ABIERTA CORRECTAMENTE")
    form.reset()
    
    this.mesas=result.mesas;


    },
    error=>{
      alert("MESA NUMERO "+this.mesamodelo.numero_mesa+"  NO PUDO ABRIRSE CORRECTAMENTE")

    }
  )}else{
    alert("Selecciona un mozo para continuar")

  }
}

abrircaja(){
  
  this.accion="abrircaja";

  this.servicio.abrircaja(this.accion).subscribe(
    result=>{
      
    this.mesas=result.mesas;
    },
    error=>{

    }
  )
}
cerrarcaja(){

  
  this.accion="cerrarcaja";

  this.servicio.cerrarcaja(this.accion).subscribe(
    result=>{
      if(result.cajas=="cajacerrada"){
alert("CAJA CERRADA SATISFACTORIAMENTE!")

    }},
    error=>{
      alert("CAJA NO CERRADA SATISFACTORIAMENTE!")
console.log(error)
    }
  )
}

}
