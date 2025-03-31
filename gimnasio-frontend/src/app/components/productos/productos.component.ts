import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ReactiveFormsModule, FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ApiService } from '../../services/api.service';

@Component({
  selector: 'app-productos',
  standalone: true,
  imports: [CommonModule, ReactiveFormsModule],
  templateUrl: './productos.component.html',
  styleUrls: ['./productos.component.css']
})
export class ProductosComponent implements OnInit {
  productos: any[] = [];
  productoForm: FormGroup;
  submitted = false;

  constructor(private api: ApiService, private fb: FormBuilder) {
    this.productoForm = this.fb.group({
      nombre: ['', [Validators.required, Validators.minLength(3)]],
      precio: ['', [Validators.required, Validators.min(0)]],
      stock: ['', [Validators.required, Validators.min(0)]]
    });
  }

  ngOnInit() {
    this.cargarProductos();
  }

  cargarProductos() {
    this.api.getProductos().subscribe(data => this.productos = data);
  }

  crearProducto() {
    this.submitted = true;
    if (this.productoForm.valid) {
      this.api.createProducto(this.productoForm.value).subscribe({
        next: () => {
          this.cargarProductos();
          this.productoForm.reset();
          this.submitted = false;
        },
        error: (error) => {
          console.error('Error:', error);
          alert('Error al crear el producto');
        }
      });
    }
  }

  get f() { return this.productoForm.controls; }
} 