
##### Hi, I'm Vyshnav! 👋


# Laravel Product Crud 
Laravel 9 and php 8.0 : Single Model crud app with Live search and pagination 


## Features

- #### Display a List of All Products:
  - Page that displays a list of all products in the database.
  - The list show the product name, description, and price.
- #### Add a New Product:
  - Form to add a new product.
  - The form for the product name, description, and price.
  - All form inputs are validated before saving the product to the database.
- #### Edit an Existing Product:
  - Functionality to edit an existing product.
  - The user can update the product name, description, and price.
  - Included validation to ensure the inputs are correct.
- #### Delete a Product:
  - Delete a product from the list.
  - Confirmation prompt is shown before deletion.
- #### Search for Products:
  - Search functionality that allows users to search for products by name.
  - The search results displayed on the same page as the product list.
- #### Paginate the Product List:
  - Pagination for the product list.
  - List displays a limited number of products per page and includes navigation links for additional pages.

## Installation

Install product_crud 

```bash
  git clone 
  cd product_crud
  cp .env.eample .env //change connection credentials on .env
  composer Install
  php artisan migrate
  php artisan db:seed --class=PrductSeeder //For seeding fake data
  php artisan serve
```
    
## Dependencies  Used
  - laravel toaster
  - Boostrap 5.0
  - SweetAlert2
  
## License

[MIT](https://choosealicense.com/licenses/mit/)


## 🔗 Links
[![portfolio](https://img.shields.io/badge/my_portfolio-000?style=for-the-badge&logo=ko-fi&logoColor=white)](https://vyshnav.web.app/)
[![linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/vyshnav-alppara/)


