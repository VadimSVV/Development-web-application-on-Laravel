public function rules(){
    return [
        'name'=>'required|max:100',
        'body'=>'required|min:2',
        'theme_id'=>'required|numeric'
        ];
}