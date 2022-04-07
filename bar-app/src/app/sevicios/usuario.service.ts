import { Injectable } from '@angular/core';
import { HttpClient,HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class UsuarioService {
  public url:string;

  constructor(private  _http: HttpClient) {
    this.url="http://localhost:8080/laestanciaangular/LaEstancia/controllers/";
    } 

  login(usuario:any,password:any,accion:any): Observable<any>{
    let headers = new HttpHeaders().set('Content-Type', 'application/json');
    var params={"usuario":usuario,"password":password,"accion":accion};
    return this._http.post(this.url+"usuariocontroller.php",params, {headers: headers});
      
    }
    logout(usuario:any,accion:any): Observable<any>{
      let headers = new HttpHeaders().set('Content-Type', 'application/json');
      var params={"usuario":usuario,"accion":accion};
      return this._http.post(this.url+"usuariocontroller.php",params, {headers: headers});
        
      }
}
