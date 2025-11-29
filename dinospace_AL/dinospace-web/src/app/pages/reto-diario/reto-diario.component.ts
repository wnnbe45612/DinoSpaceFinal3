import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { DomSanitizer, SafeHtml } from '@angular/platform-browser';

// Define la estructura de un reto diario
interface RetoDiario {
  titulo: string;
  descripcion: string;
  duracion: string;
  dificultad: string;
  categoria: string;
  objetivo: string;
  beneficios: string;
  pasos: string;
  id?: number;
}

@Component({
  standalone: true,
  selector: 'app-reto-diario',
  imports: [CommonModule],
  templateUrl: './reto-diario.component.html',
  styleUrls: ['./reto-diario.component.css'],
})
export class RetoDiarioComponent implements OnInit {
  // Almacena el reto diario actual
  reto: RetoDiario | null = null;

  // Almacena la ruta de la imagen según la categoría
  imagenCategoria: string = '';

  // Almacena los pasos del reto formateados de manera segura
  pasosSanitizados: SafeHtml = '';

  constructor(private sanitizer: DomSanitizer) {}

  ngOnInit(): void {
    // Obtiene el reto del almacenamiento local al cargar el componente
    const data = localStorage.getItem('retoDiario');

    if (data) {
      this.reto = JSON.parse(data);
      this.sanitizarPasos();
      this.asignarImagen();
    }
  }

  // Convierte el texto de pasos en HTML seguro para mostrar
  private sanitizarPasos(): void {
    if (!this.reto?.pasos) return;

    // Divide los pasos por guiones y limpia cada línea
    const pasos = this.reto.pasos
      .split('-')
      .map((l) => l.trim())
      .filter((l) => l);

    // Convierte cada paso en HTML con formato
    const html = pasos
      .map((texto, index) => {
        // Elimina el prefijo "Paso X:" si existe
        const limpio = texto.replace(/^Paso\s*\d+:\s*/i, '').trim();

        return `
      <li class="paso-item">
        <img src="assets/images/dino_paso.png" class="icono-paso" alt="Dino paso" />
        <span><strong>Paso ${index + 1}:</strong> ${limpio}</span>
      </li>
    `;
      })
      .join('');

    // Hace el HTML seguro para evitar ataques XSS
    this.pasosSanitizados = this.sanitizer.bypassSecurityTrustHtml(html);
  }

  // Asigna una imagen diferente según la categoría del reto
  private asignarImagen(): void {
    if (!this.reto) return;

    // Mapea categorías a imágenes específicas
    const categorias: Record<string, string> = {
      'Consejos prácticos': 'assets/images/dino_consejo.png',
      'Historias motivadoras': 'assets/images/dino_historia.png',
      'Técnicas de estudio': 'assets/images/dino_tecnicas.png',
    };

    // Usa la imagen correspondiente o una por defecto
    this.imagenCategoria = categorias[this.reto.categoria] || 'assets/images/dino_otro.png';
  }
}
