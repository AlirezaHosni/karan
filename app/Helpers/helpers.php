<?php

use Morilog\Jalali\Jalalian;

function jalaliDate($date, $format='%Y %m %d')
{
    return Jalalian::forge($date)->format($format);
}

function getLesson($item)
{
    if (get_class($item) == \App\Lesson::class)
        return $item;
    elseif(get_class($item) == \App\book::class)
        return $item->lesson;
    elseif (get_class($item) == \App\Topic::class)
        return $item->book->lesson;
}

function getSession($item)
{
    if (get_class($item) == \App\book::class){
        if ($item->part !== null)
            return $item->session_book;
        return $item;
    }
    elseif (get_class($item) == \App\Topic::class)
        return $item->book->session_book;
}

function getRoute($operation, $item)
{
    if ($operation == 'lesson'){
        $lesson = getLesson($item);
        return route('lesson.chooseLessonItem', $lesson->id);
    }elseif ($operation == 'exam'){
        $lesson = getLesson($item);
        return route('lesson.chooseSelectionExamItem', $lesson->id);
    }elseif ($operation == 'examQuestionSample'){
        $lesson = getLesson($item);
        return route('lesson.chooseBookExerciseSession', $lesson->id);
    }else{
        if (get_class($item) == \App\Lesson::class)
            return route('sessionBook', [getLesson($item)->id, $operation]);
        elseif ($operation == 'appendices'){
            $session = getSession($item);
            return route('appendices.chooseAppendicesItem', $session->id);
        }elseif ($operation == 'bookExercises'){
            $session = getSession($item);
            return route('overview.' . $operation, $session->id);
        }elseif ($operation == 'generalTest'){
            $session = getSession($item);
            return route('overview.' . $operation, $session->id);
        }
        elseif (get_class($item) == \App\book::class){
            return route('book', [getSession($item)->id, $operation]);
        }
        elseif(get_class($item) == \App\Topic::class)
            return route('overview.' . $operation, $item->id) ;
    }



}
