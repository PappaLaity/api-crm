## API-CRM

An api for Mini CRM of Batimat Group Included
CRM : relation client

- Achat : achat de produits auprès des fournisseurs et suivi de la facturation fournisseur
- Stock : gestion des stocks de marchandises
- Vente : vente de marchandises aux clients
- Facturation : gestion du compte client, des factures client et des paiements

### MCD

![MCD Projet](/MCD.drawio.png)

### Diagramme de Classe

![Class Diagram](/api_crm_diagram.png)

### Features Developed

- Login
- CRUD USER
- CRUD Structure (Including Company & Providers)
- CRUD Customers
- CRUD Products
- CRUD STOCK
- CRUD ORDERS
- CRUD ORDER LINES

### Project setup

```
composer install
```
```
cp .env.examle .env
```
```
php artisan migrate --seed
```
```
php artisan serve
```
### Http File for Exemple Request
`api-crm.http`
### Environment PhpStorm
