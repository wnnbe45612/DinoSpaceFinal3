import {
  ApplicationConfig,
  provideBrowserGlobalErrorListeners,
  provideZoneChangeDetection,
} from '@angular/core';
import { provideRouter } from '@angular/router';
import { provideHttpClient, withFetch } from '@angular/common/http';
import { routes } from './app.routes';
import { provideClientHydration, withEventReplay } from '@angular/platform-browser';

export const appConfig: ApplicationConfig = {
  providers: [
    // Proporciona manejadores globales de errores en el navegador
    provideBrowserGlobalErrorListeners(),

    // Configura la detección de cambios de Angular con coalescencia de eventos
    provideZoneChangeDetection({ eventCoalescing: true }),

    // Proporciona el sistema de rutas de la aplicación
    provideRouter(routes),

    // Habilita la hidratación del lado del cliente con reproducción de eventos
    provideClientHydration(withEventReplay()),

    // Configura el cliente HTTP usando fetch API
    provideHttpClient(withFetch()),
  ],
};
