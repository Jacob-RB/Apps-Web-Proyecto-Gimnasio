import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';
import { AuthService } from '../../services/auth.service';

@Component({
  selector: 'app-dashboard',
  standalone: true,
  imports: [CommonModule, RouterModule],
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent {
  menuItems = [
    { path: 'ventas', label: 'Ventas' },
    { path: 'clientes', label: 'Clientes' },
    { path: 'productos', label: 'Productos' }
  ];

  constructor(private authService: AuthService) {}

  logout() {
    this.authService.logout();
  }
} 