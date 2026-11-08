# Class Diagram - Lab MMT

```plantuml
@startuml
skinparam classAttributeIconSize 0

class Database {
  - connection
  + __construct()
  + fetch(query, params)
  + fetchAll(query, params)
  + execute(query, params)
}

class App {
  - controller
  - method
  - params[]
  + __construct()
  + parseUrl()
  + loadController()
}

abstract class Controller {
  # view(view, data)
  # model(model)
  # redirect(url)
}

class HomeController extends Controller {
  + index()
  + about()
  + contact()
}

class ProjectController extends Controller {
  + index()
  + detail(slug)
  + rate(id)
  + comment(id)
}

class ArticleController extends Controller {
  + index()
  + detail(slug)
}

class GalleryController extends Controller {
  + index()
}

class AuthController extends Controller {
  + login()
  + logout()
}

class AdminController extends Controller {
  + index()
  + projects()
  + createProject()
  + editProject(id)
  + deleteProject(id)
  + articles()
  + createArticle()
  + editArticle(id)
  + deleteArticle(id)
  + gallery()
  + createGallery()
  + editGallery(id)
  + deleteGallery(id)
  + partners()
  + createPartner()
  + editPartner(id)
  + deletePartner(id)
  + comments()
  + deleteComment(id)
  + users()
  + createUser()
  + editUser(id)
  + deleteUser(id)
}

class Project {
  - db: Database
  + getAll()
  + getById(id)
  + getBySlug(slug)
  + getByCategory(category)
  + search(keyword)
  + create(data)
  + update(id, data)
  + delete(id)
  + generateSlug(title)
}

class Article {
  - db: Database
  + getAll()
  + getById(id)
  + getBySlug(slug)
  + getRecent(limit)
  + create(data)
  + update(id, data)
  + delete(id)
  + generateSlug(title)
}

class Gallery {
  - db: Database
  + getAll()
  + getById(id)
  + getByType(type)
  + create(data)
  + update(id, data)
  + delete(id)
}

class Partner {
  - db: Database
  + getAll()
  + getById(id)
  + create(data)
  + update(id, data)
  + delete(id)
}

class ProjectComment {
  - db: Database
  + getByProject(projectId)
  + getAll()
  + create(data)
  + delete(id)
}

class ProjectRating {
  - db: Database
  + getByProject(projectId)
  + getAverage(projectId)
  + create(data)
}

class User {
  - db: Database
  + getAll()
  + getById(id)
  + getByEmail(email)
  + create(data)
  + update(id, data)
  + delete(id)
  + authenticate(email, password)
}

' Relationships
App --> Controller
Controller --> Database

HomeController --> Project
HomeController --> Article
HomeController --> Partner

ProjectController --> Project
ProjectController --> ProjectComment
ProjectController --> ProjectRating

ArticleController --> Article
GalleryController --> Gallery
AdminController --> Project
AdminController --> Article
AdminController --> Gallery
AdminController --> Partner
AdminController --> ProjectComment
AdminController --> User

Project --> Database
Article --> Database
Gallery --> Database
Partner --> Database
ProjectComment --> Database
ProjectRating --> Database
User --> Database

@enduml
```

## Deskripsi Class

### Core Classes
- **App**: Main application router
- **Controller**: Base controller (abstract)
- **Database**: Database connection handler

### Controllers
- **HomeController**: Homepage, about, contact
- **ProjectController**: Project listing, detail, rating, comment
- **ArticleController**: Article listing and detail
- **GalleryController**: Gallery display
- **AuthController**: Login/logout
- **AdminController**: Admin panel CRUD operations

### Models
- **Project**: Project management (with team_name, team_members)
- **Article**: Article/news management
- **Gallery**: Media gallery (image/video)
- **Partner**: Partner/collaboration management
- **ProjectComment**: Project comments
- **ProjectRating**: Project ratings (1-5)
- **User**: User management (admin/editor roles)

