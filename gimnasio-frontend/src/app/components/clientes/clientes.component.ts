import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ReactiveFormsModule, FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ApiService } from '../../services/api.service';

@Component({
  selector: 'app-clientes',
  standalone: true,
  imports: [CommonModule, ReactiveFormsModule],
  templateUrl: './clientes.component.html',
  styleUrls: ['./clientes.component.css']
})
export class ClientesComponent implements OnInit {
  clientes: any[] = [];
  clienteForm: FormGroup;
  submitted = false;

  constructor(private api: ApiService, private fb: FormBuilder) {
    this.clienteForm = this.fb.group({
      nombre: ['', [Validators.required, Validators.minLength(3)]],
      email: ['', [Validators.required, Validators.email]],
      telefono: ['', [Validators.required, Validators.pattern('[0-9]{9}')]]
    });
  }

  ngOnInit() {
    this.cargarClientes();
  }

  cargarClientes() {
    this.api.getClientes().subscribe(data => this.clientes = data);
  }

  crearCliente() {
    this.submitted = true;
    if (this.clienteForm.valid) {
      this.api.createCliente(this.clienteForm.value).subscribe({
        next: () => {
          this.cargarClientes();
          this.clienteForm.reset();
          this.submitted = false;
        },
        error: (error) => {
          console.error('Error:', error);
          alert('Error al crear el cliente');
        }
      });
    }
  }

  get f() { return this.clienteForm.controls; }
} 