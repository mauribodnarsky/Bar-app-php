import { Injectable } from '@angular/core';
import { HttpClient,HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ComandasService {

  public url:string;

  constructor(private  _http: HttpClient) {
    this.url="http://localhost:8080/laestanciaangular/LaEstancia/controllers/";
    } 

  buscarproducto(texto:any,accion:any): Observable<any>{
    let headers = new HttpHeaders().set('Content-Type', 'application/json');
    var params={"texto":texto,"accion":accion};
    return this._http.post(this.url+"comandacontroller.php",params, {headers: headers});
      
    }
    agregarproducto(codigo:any,cantidad:any,accion:any,mesa:any): Observable<any>{
      let headers = new HttpHeaders().set('Content-Type', 'application/json');
      var params={"codigo":codigo,"cantidad":cantidad,"accion":accion,"mesa":mesa};
      return this._http.post(this.url+"comandacontroller.php",params, {headers: headers});   
      }
      abrirmesa(mesa:any,mozo:any,accion:any):Observable<any>{
        let headers=new HttpHeaders().set("Content-Type","application/json");
        var params={"mesa":mesa,"mozo":mozo,"accion":accion};
        return this._http.post(this.url+"comandacontroller.php",params,{headers:headers});
      }
      cerrarmesa(mesa:any,accion:any):Observable<any>{
        let headers=new HttpHeaders().set("Content-Type","application/json");
        var params={"mesa":mesa,"accion":accion};
        return this._http.post(this.url+"comandacontroller.php",params,{headers:headers});
      }
      seleccionarmesa(mesa:any,accion:any):Observable<any>{
        let headers=new HttpHeaders().set("Content-Type","application/json");
        var params={"mesa":mesa,"accion":accion};
        return this._http.post(this.url+"comandacontroller.php",params,{headers:headers});
      }
      
      editarfactura(mesa:any,accion:any):Observable<any>{
        let headers=new HttpHeaders().set("Content-Type","application/json");
        var params={"mesa":mesa,"accion":accion};
        return this._http.post(this.url+"comandacontroller.php",params,{headers:headers});
      }
      cerrarcaja(accion:any):Observable<any>{
        let headers=new HttpHeaders().set("Content-Type","application/json");
        var params={"accion":accion};
        console.log("params")

        console.log(params)
        return this._http.post(this.url+"cajacontroller.php",params,{headers:headers});
      }
      abrircaja(accion:any):Observable<any>{
        let headers=new HttpHeaders().set("Content-Type","application/json");
        var params={"accion":accion};
        return this._http.post(this.url+"cajacontroller.php",params,{headers:headers});
      }

    }