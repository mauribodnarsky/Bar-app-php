import { Injectable } from '@angular/core';
import { HttpClient,HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AdministracionService {
  public url:string;

  constructor(private  _http: HttpClient) {
    this.url="http://localhost:8080/apivobar/controllers/";
    } 

  guardarproducto(nombre:any,precio:any,codigo:any,accion:any): Observable<any>{
    let headers = new HttpHeaders().set('Content-Type', 'application/json');
    var params={"nombre":nombre,"precio":precio,"codigo":codigo,"accion":accion};
    return this._http.post(this.url+"productocontroller.php",params, {headers: headers});
      
    }
    editarproducto(id:any,nombre:any,precio:any,codigo:any,accion:any): Observable<any>{
      let headers = new HttpHeaders().set('Content-Type', 'application/json');
      var params={"id":id,"nombre":nombre,"precio":precio,"codigo":codigo,"accion":accion};
      return this._http.post(this.url+"productocontroller.php",params, {headers: headers});
        
      }
      eliminarproducto(id:any,accion:any): Observable<any>{
        let headers = new HttpHeaders().set('Content-Type', 'application/json');
        var params={"id":id,"accion":accion};
        return this._http.post(this.url+"productocontroller.php",params, {headers: headers});
          
        }
        crearmozo(nombre:any,accion:any): Observable<any>{
          let headers = new HttpHeaders().set('Content-Type', 'application/json');
          var params={"nombre":nombre,"accion":accion};
          return this._http.post(this.url+"usuariocontroller.php",params, {headers: headers});
            
          }
          estadisticas_cajas(accion:any): Observable<any>{
            let headers = new HttpHeaders().set('Content-Type', 'application/json');
            var params={"accion":accion};
            return this._http.post(this.url+"usuariocontroller.php",params, {headers: headers});
              
            }
            estadisticas_productos(accion:any): Observable<any>{
              let headers = new HttpHeaders().set('Content-Type', 'application/json');
              var params={"accion":accion};
              return this._http.post(this.url+"usuariocontroller.php",params, {headers: headers});
                
              }
        agregarmesa(accion:any): Observable<any>{
          let headers = new HttpHeaders().set('Content-Type', 'application/json');
          var params={"accion":accion};
          return this._http.post(this.url+"usuariocontroller.php",params, {headers: headers});
            
          }
}
