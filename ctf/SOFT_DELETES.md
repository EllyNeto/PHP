# Guia de Uso: Soft Deletes no Laravel

Este documento explica como funciona o recurso de **Soft Deletes** (Exclusão Lógica) no projeto e como acessar, restaurar e gerenciar registros excluídos suavemente.

---

## 1. O que são Soft Deletes?

Quando o recurso de **Soft Deletes** está ativado em uma tabela:
- Ao chamar o método `delete()`, o registro **não é apagado do banco de dados**.
- Em vez disso, a coluna `deleted_at` é preenchida com a data/hora atual.
- As consultas padrão do Eloquent filtram automaticamente os registros onde `deleted_at` é nulo (`WHERE deleted_at IS NULL`).

---

## 2. Tabelas e Models com Soft Deletes no Projeto

Todas as tabelas do projeto possuem suporte a Soft Deletes:
- `users` (`App\Models\User`)
- `inscriptions` (`App\Models\Inscription_model`)
- `finance` (`App\Models\Finance_model`)
- `courses` (`App\Models\CourseModel`)
- `teachers` (`App\Models\TeacherModel`)
- `classes` (`App\Models\ClasseModel`)
- `students` (`App\Models\StudentModel`)

---

## 3. Como usar no Eloquent ORM

### 3.1 Realizar Soft Delete (Exclusão Suave)
Para enviar um registro para a "lixeira" (preencher `deleted_at`):

```php
use App\Models\CourseModel;

$course = CourseModel::find(1);
$course->delete();
```

---

### 3.2 Consultas Básicas

#### A. Consultar apenas ativos (Padrão)
Por padrão, registros com `deleted_at` preenchido são ignorados:

```php
// Retorna apenas registros onde deleted_at IS NULL
$courses = CourseModel::all();
```

#### B. Incluir registros deletados (`withTrashed`)
Para trazer tanto registros ativos quanto deletados:

```php
$allCourses = CourseModel::withTrashed()->get();

// Buscar por ID incluindo deletados
$course = CourseModel::withTrashed()->find(1);
```

#### C. Consultar APENAS registros deletados (`onlyTrashed`)
Para listar apenas os itens que estão na lixeira:

```php
$trashedCourses = CourseModel::onlyTrashed()->get();
```

---

### 3.3 Verificar se um registro foi deletado

```php
$course = CourseModel::withTrashed()->find(1);

if ($course->trashed()) {
    // O registro está na lixeira (deleted_at não é nulo)
}
```

---

### 3.4 Restaurar um registro deletado (`restore`)

Para restaurar um registro da lixeira (definir `deleted_at` como `NULL`):

```php
// Restaurando uma instância específica
$course = CourseModel::withTrashed()->find(1);
$course->restore();

// Restaurar em lote
CourseModel::onlyTrashed()->where('type', 'online')->restore();
```

---

### 3.5 Exclusão Definitiva (`forceDelete`)

Para remover o registro **permanentemente** do banco de dados:

```php
// Remover permanentemente um registro específico
$course = CourseModel::withTrashed()->find(1);
$course->forceDelete();

// Limpar permanentemente todos da lixeira
CourseModel::onlyTrashed()->forceDelete();
```

---

## 4. Exemplos Práticos no Artisan Tinker

Você pode testar esses comandos no terminal via `php artisan tinker`:

```bash
php artisan tinker
```

```php
// 1. Criar um curso
$course = App\Models\CourseModel::create(['name' => 'PHP Avançado', 'type' => 'Presencial', 'description' => 'Curso de PHP', 'duration' => 40]);

// 2. Soft delete
$course->delete();

// 3. Listar apenas deletados
App\Models\CourseModel::onlyTrashed()->get();

// 4. Restaurar curso
$course->restore();

// 5. Deletar permanentemente
$course->forceDelete();
```

---

## 5. Como usar com Query Builder (`DB::table`)

Caso esteja utilizando a facade `DB` diretamente (sem o Eloquent Model):

```php
use Illuminate\Support\Facades\DB;

// Obter apenas deletados
$trashed = DB::table('courses')->whereNotNull('deleted_at')->get();

// Soft delete manual
DB::table('courses')->where('id', 1)->update(['deleted_at' => now()]);

// Restaurar manual
DB::table('courses')->where('id', 1)->update(['deleted_at' => null]);
```
