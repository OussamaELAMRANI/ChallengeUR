 Coding Challenge UR
---

Application Full Stack based on Laravel and VueJs

## Back end [Laravel]  

#### You can use this application directly by executing instructions below 
    # composer install
    # cp .env.example .env
    # php artisan key:generate
    
### Install Passport
    # php artisan passport:install

### Run the database migrations 
#### (Set the database connection in .env before migrating)
    # php artisan migrate

#### Run the database seeder to generate a list of ten Shops
    # php artisan db:seed

### Start the local development server
    # php artisan serve

## Font end [Vuejs]  

### Install dependencies (Make sure you have Nodejs install in your machine)
    # npm install 

###  if use Yarn as a package manager
    # yarn install 

### Run your dev watcher 
    # npm run dev
    
### Or run Webpack Server on port 3000
    # npm run hot

### *NB* 
> Make to add a User Address at US, because the [factory generator] generate addresses in US, and that make Google API calculate a real distance, otherwise will send no data if was so far
