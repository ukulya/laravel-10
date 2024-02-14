namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Book extends Model{
    // we can define/override explicitly the table name and other fileds
    protected $table = "my_books"; // default 'books'
    protected $primarykey = "book_id"; // default 'id'

    // disable the auto incrementing of id
    protected $incrementing = false;

    // if you want to take care of the autofilled column values such as 'created_at','updated_at'
    protected $timestamps = false
}