export interface User {
  id?: number;
  name: string;
  email: string;
  email_verified_at?: string;
  created_at?: string;
  updated_at?: string;
}

export interface Cliente {
  id?: number;
  nombre: string;
  email: string;
  telefono: string;
  created_at?: string;
  updated_at?: string;
  subscriptions?: Subscription[];
  sales?: Sale[];
}

export interface Employee {
  id?: number;
  nombre: string;
  puesto: string;
  created_at?: string;
  updated_at?: string;
  schedules?: Schedule[];
}

export interface Product {
  id?: number;
  nombre: string;
  precio: number;
  stock: number;
  created_at?: string;
  updated_at?: string;
}

export interface Sale {
  id?: number;
  client_id: number;
  product_id: number;
  cantidad: number;
  total: number;
  created_at?: string;
  updated_at?: string;
  client?: Cliente;
  product?: Product;
}

export interface Subscription {
  id?: number;
  client_id: number;
  tipo: string;
  fecha_inicio: string;
  fecha_fin: string;
  created_at?: string;
  updated_at?: string;
  client?: Cliente;
}

export interface Schedule {
  id?: number;
  employee_id: number;
  fecha: string;
  hora_inicio: string;
  hora_fin: string;
  created_at?: string;
  updated_at?: string;
  employee?: Employee;
} 