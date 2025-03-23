# **📝 Kanban Board**  
A **lightweight and efficient Kanban Board** built with **Laravel 10, Vue.js 3, Inertia.js, Tailwind CSS, and SQLite/MySQL** for managing tasks with a drag-and-drop interface.

---

## **🚀 Features**  
👉 **View all tasks** on a Kanban board  
👉 **Drag & drop tasks** between columns  
👉 **Create, edit, and delete tasks**  
👉 **Persistent storage** with SQLite or MySQL  
👉 **Fast & modern UI** powered by Vue 3 & Tailwind CSS  

---

## **🛠 Tech Stack**  
🔹 **Backend**: Laravel 10, SQLite/MySQL  
🔹 **Frontend**: Vue.js 3, Inertia.js, Tailwind CSS  
🔹 **Build Tools**: Vite  

---

## **👅 Installation**  
Clone the repository and set up the project:  
```sh
git clone https://github.com/yourusername/kanban-board.git
cd kanban-board
composer install
npm install
cp .env.example .env
php artisan key:generate
```

### **Database Setup**  
For SQLite (default setup):  
```sh
touch database/database.sqlite
```
Run database migrations & seeders:  
```sh
php artisan migrate --seed
```

---

## **👅 Run the Project**  
Start the **backend (Laravel)**:  
```sh
php artisan serve
```
> App will run at **http://127.0.0.1:8000**  

Start the **frontend (Vue + Vite)**:  
```sh
npm run dev
```
> Vue app will be available at **http://127.0.0.1:5173**  

---

## **📀 Usage**  
1️⃣ **Add new tasks** to the board.  
2️⃣ **Drag & drop tasks** between columns.  
3️⃣ **Click on a task** to edit or delete it.  

---

## **🛠 Development**  
For hot reloading during development:  
```sh
npm run dev
```
To build the frontend for production:  
```sh
npm run build
```
