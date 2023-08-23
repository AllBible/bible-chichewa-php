<?php

namespace ChichewaBible;

class Bible
{
    /**
     * Retrieves a specific verse from the Bible.
     *
     * @param string $book The name of the book.
     * @param int $chapter The chapter number.
     * @param int $verse The verse number.
     * @return string|null The requested verse text, or null if not found.
     */
    public function getVerse($book, $chapter, $verse)
    {
        $bible = file_get_contents("./resources/$book/$chapter.json");
        $verses = json_decode($bible);
        return $verses[(int) $verse - 1] ?? null;
    }

    /**
     * Retrieves a range of verses from the Bible.
     *
     * @param string $book The name of the book.
     * @param int $chapter The chapter number.
     * @param int $verseStart The starting verse number.
     * @param int $verseEnd The ending verse number.
     * @return array The array of requested verses.
     */
    public function getVerses($book, $chapter, $verseStart, $verseEnd)
    {
        $bible = file_get_contents("./resources/$book/$chapter.json");
        $verses = json_decode($bible);
        return array_slice($verses, (int) $verseStart - 1, (int) $verseEnd - $verseStart + 1);
    }

    /**
     * Retrieves all verses from a specific chapter of the Bible.
     *
     * @param string $book The name of the book.
     * @param int $chapter The chapter number.
     * @return array The array of verses in the chapter.
     */
    public function getChapter($book, $chapter)
    {
        $bible = file_get_contents("./resources/$book/$chapter.json");
        $verses = json_decode($bible);
        return $verses;
    }

    /**
     * Retrieves the number of chapters in a specific book of the Bible.
     *
     * @param int $book The index of the book.
     * @return int The number of chapters in the book.
     */
    public function getChapterCount($book)
    {
        // Get Books of the Bible
        $books = file_get_contents('./content/books.json');
        $books = json_decode($books);
        return (int) $books[(int) $book - 1]->chapters;
    }

    /**
     * Retrieves the number of verses in a specific chapter of the Bible.
     *
     * @param string $book The name of the book.
     * @param int $chapter The chapter number.
     * @return int The number of verses in the chapter.
     */
    public function getVerseCount($book, $chapter)
    {
        $bible = file_get_contents("./resources/$book/$chapter.json");
        $verses = json_decode($bible);
        return count($verses);
    }

    /**
     * Retrieves an array of book names.
     *
     * @return array The array of book names.
     */
    public function getBooks()
    {
        $books = file_get_contents('./content/books.json');
        $books = json_decode($books);
        return array_map("_mapBookName", $books);
    }

    /**
     * Maps the book object to its name.
     *
     * @param object $book The book object.
     * @return string The name of the book.
     */
    private function _mapBookName($book)
    {
        return $book->name;
    }

}
?>