namespace App\Http\Controllers;
use App\Article;
use Illuminate\Http\Request;
use App\Catalog;
use App\MaterialPicture;

class IndexController extends Controller
{
    public function hetChapt () {
        $getChapter = Catalog::where('parent_id', 0)->get();
        return view('index', compact('getChapter'));
    }

    public function getCat(){
        return view('article_list');
    }

    public function getArt($prog=null, $cat=null, $id=null){
        $pictures = MaterialPicture::where('url',$cat)
            ->orderBy('id','DESC')->get();
        $catalog = Catalog::where('url', $cat)->first();
        $previous = Article::where('id, '<', $id)
            ->where('cat_id', $catalog->id)->
                ->max('id');
        $next = Article::where('id', '>', $id)->
            ->where('cat_id', $catalog->id)->
                ->min('id');
        return view('article_show', compact('previous','next','pictures'));
    }
}