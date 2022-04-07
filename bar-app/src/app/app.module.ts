import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule  } from '@angular/forms';
import { HttpClientModule} from '@angular/common/http';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { ComandasComponent } from './componentes/comandas/comandas.component';
import { AdministracionComponent } from './componentes/administracion/administracion.component';
import { CajasComponent } from './componentes/cajas/cajas.component';
import { EstadisticasComponent } from './componentes/estadisticas/estadisticas.component';
import { LoginComponent } from './componentes/login/login.component';

@NgModule({
  declarations: [
    AppComponent,
    ComandasComponent,
    AdministracionComponent,
    CajasComponent,
    EstadisticasComponent,
    LoginComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    FormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
