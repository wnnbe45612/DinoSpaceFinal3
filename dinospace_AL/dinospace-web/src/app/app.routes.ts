import { Routes } from '@angular/router';
import { HomeComponent } from 'src/app/pages/home/home.component';
import { LoginComponent } from 'src/app/pages/login/login.component';
import { RegisterComponent } from 'src/app/pages/register/register.component';
import { DashboardComponent } from 'src/app/pages/dashboard/dashboard.component';

export const routes: Routes = [
  // Ruta para la página de inicio
  { path: '', component: HomeComponent },

  // Ruta para la página de inicio de sesión
  { path: 'login', component: LoginComponent },

  // Ruta para la página de registro
  { path: 'register', component: RegisterComponent },

  // Ruta principal del dashboard con rutas hijas
  {
    path: 'dashboard',
    component: DashboardComponent,
    children: [
      // Ruta hija por defecto que carga el contenido principal del dashboard
      {
        path: '',
        loadComponent: () =>
          import('src/app/pages/dashboard-content/dashboard-content.component').then(
            (m) => m.DashboardContentComponent
          ),
      },
      // Ruta hija para la página de reto diario (carga perezosa)
      {
        path: 'reto-diario',
        loadComponent: () =>
          import('src/app/pages/reto-diario/reto-diario.component').then(
            (m) => m.RetoDiarioComponent
          ),
      },
      // Ruta hija para la página de recomendaciones (carga perezosa)
      {
        path: 'recomendaciones',
        loadComponent: () =>
          import('src/app/pages/recomendaciones/recomendaciones.component').then(
            (m) => m.RecomendacionesComponent
          ),
      },
      // Ruta hija para la página del chatbot Dinobot (carga perezosa)
      {
        path: 'dinobot',
        loadComponent: () =>
          import('src/app/pages/dinobot/dinobot.component').then((m) => m.DinobotComponent),
      },
    ],
  },
];
