import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ComandasComponent } from './componentes/comandas/comandas.component';
import { AdministracionComponent } from './componentes/administracion/administracion.component';
import { CajasComponent } from './componentes/cajas/cajas.component';
import { EstadisticasComponent } from './componentes/estadisticas/estadisticas.component';
import { LoginComponent } from './componentes/login/login.component';
const routes: Routes = [
  {path: "comandas", component: ComandasComponent},
  {path: "administracion",component: AdministracionComponent},
  {path: "cajas",component: CajasComponent},
  {path: "estadisticas",component: EstadisticasComponent}];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
