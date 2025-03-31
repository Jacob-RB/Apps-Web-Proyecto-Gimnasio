import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ReactiveFormsModule, FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ApiService } from '../../services/api.service';
import { Sale, Product, Cliente } from '../../interfaces/models';

@Component({
  selector: 'app-ventas',
  standalone: true,
  imports: [CommonModule, ReactiveFormsModule],
  templateUrl: './ventas.component.html',
  styleUrls: ['./ventas.component.css']
})
export class VentasComponent implements OnInit {
  ventaForm: FormGroup;
  ventas: Sale[] = [];
  productos: Product[] = [];
  clientes: Cliente[] = [];
  submitted = false;

  constructor(private api: ApiService, private fb: FormBuilder) {
    this.ventaForm = this.fb.group({
      client_id: ['', Validators.required],
      product_id: ['', Validators.required],
      cantidad: ['', [Validators.required, Validators.min(1)]]
    });
  }

  ngOnInit() {
    this.cargarDatos();
  }

  cargarDatos() {
    this.api.getVentas().subscribe(data => this.ventas = data);
    this.api.getProductos().subscribe(data => this.productos = data);
    this.api.getClientes().subscribe(data => this.clientes = data);
  }

  registrarVenta() {
    this.submitted = true;
    if (this.ventaForm.valid) {
      this.api.createVenta(this.ventaForm.value).subscribe({
        next: () => {
          this.cargarDatos();
          this.ventaForm.reset();
          this.submitted = false;
        },
        error: (error) => {
          console.error('Error:', error);
          alert('Error al registrar la venta');
        }
      });
    }
  }

  get f() { return this.ventaForm.controls; }
} 