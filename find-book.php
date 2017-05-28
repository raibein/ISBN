<?php

define("ROOT", __DIR__);


//path to directory to scan
$directory = "xml/";


//get all image files with a .txt extension.
$dir = ROOT."\*.xml";


//print_r($file = glob($dir));
$file = glob($dir);
//var_dump($file);


// get isbn
$isbn=$_POST['isbn'];


//print each file name
foreach($file as $filew)
{
   //print_r($filew);
   //$files[] = $filew; // to create the array
   

   // create url
   //$url='http://isbndb.com/api/books.xml?access_key=API_KEY&results=details&index1=isbn&value1='.$isbn;
   //$url='books.xml?access_key=.'$access_key'.&results=details&index1=isbn&value1='.$isbn;
   //$url="books.xml";


   // load url into $response
   //$response=simplexml_load_file($url);
   $response=simplexml_load_file($filew);

   $data = $response->BookList->BookData;

   //var_dump($data);

   $isbn10 = $data['isbn'];
   $isbn13 = $data['isbn13'];
   $bookTitle = $data->Title;
   $bookLong = $data->TitleLong;
   $bookAuthor = $data->AuthorsText;
   $bookPublisher = $data->PublisherText;
   $bookEdition = $data->Details['edition_info'];
   $bookLanguage = $data->Details['language'];
   $bookPhysicalDesc = $data->Details['physical_description_text'];

   
   /*
   if($response->BookList['total_results']>0)
   {
   // we got at least one result

      // assign each book to $book
      
   }

   foreach($response->BookList->BookData as $book)
   {
      $isbn10 = "{$book['isbn']}";
      $isbn13 = "{$book['isbn13']}";
      $bookTitle = "{$book->Title}";
      $bookLong = "{$book->TitleLong}";
      $bookAuthor = "{$book->AuthorsText}";
      $bookPublisher = "{$book->PublisherText}";
      $bookEdition = "{$book->Details['edition_info']}";
      $bookLanguage = "{$book->Details['language']}";
      $bookPhysicalDesc = "{$book->Details['physical_description_text']}";
   }
   */


   // check if we got at least one result 
   if($isbn == $isbn10 || $isbn == $isbn13 && $isbn != "")
   {
      echo 
      "<table class='table table-striped table-bordered'>
         <tr>
            <th>Short Title: </th>
            <td>{$bookTitle}</td>
         </tr>
         <tr>
            <th>Long Title: </th>
            <td>{$bookLong} </td>
         </tr>
         <tr>
            <th>Author(s): </th>
            <td>{$bookAuthor}</td>
         </tr>
         <tr>
            <th>Publisher: </th>
            <td>{$bookPublisher}</td>
         </tr>
         <tr>
            <th>ISBN10: </th>
            <td>{$isbn10}</td>
         </tr>
         <tr>
            <th>ISBN13: </th>
            <td>$isbn13</td>
         </tr>
         <tr>
            <th>Edition Information: </th>
            <td>{$bookEdition}</td>
         </tr>
         <tr>
            <th>Language: </th>
            <td>{$bookLanguage}</td>
         </tr>
         <tr>
            <th>Physical Description: </th>
            <td>{$bookPhysicalDesc}</td>
         </tr>
     </table>";
     return false;
   } 
}

if($isbn == "")
{
   echo '<div class="alert alert-danger"><strong>Please ISBN no must not Empty</strong></div>';
}
elseif($isbn !== $isbn10 || $isbn !== $isbn13 && $isbn !== "")
{
   echo '<div class="alert alert-warning"><strong>No book was found with ISBN: '.$isbn. '</strong></div>';
}


?>