<?php

enum SubjectType: string
{
    case MAIN = 'Principales';
    case OTHERS = 'Autres';
    case HUMAS = 'Humanités';

    public static function fromString(string $type): SubjectType | null
    {
        return match ($type) {
            'main' => SubjectType::MAIN,
            'others' => SubjectType::OTHERS,
            'humas' => SubjectType::HUMAS,
            default => null,
        };
    }
}

enum SubjectColor: string
{
    case RED = '#CD0E14';
    case ORANGE = '#e3980e';
    case YELLOW = '#a29b14';
    case GREEN = '#008000';
    case BLUE = '#265fa3';
    case MAROON = '#893939';
    case GRAY = '#4c525c';
    case LIGHTGRAY = '#8d99ae';
    case PINK = '#e458a3';
    case PURPLE = '#990d9c';

    public static function fromString(string $color): SubjectColor | null
    {
        return match ($color) {
            'red' => SubjectColor::RED,
            'orange' => SubjectColor::ORANGE,
            'yellow' => SubjectColor::YELLOW,
            'green' => SubjectColor::GREEN,
            'blue' => SubjectColor::BLUE,
            'maroon' => SubjectColor::MAROON,
            'gray' => SubjectColor::GRAY,
            'lightgray' => SubjectColor::LIGHTGRAY,
            'pink' => SubjectColor::PINK,
            'purple' => SubjectColor::PURPLE,
            default => null,
        };
    }
}

function update_subject(mixed $id, mixed $name, mixed $color, mixed $type, $class_id): array
{
    $type = SubjectType::fromString($type);
    $color = SubjectColor::fromString($color);
    if ($type === null || $color === null) {
        return array("Type ou couleur invalide.");
    }
    if (strlen($name) > 16) {
        return array("Le nom de la matière ne doit pas dépasser 16 caractères.");
    }

    $q = getDB()->prepare("UPDATE subjects SET name=:name, color=:color, type=:type WHERE id=:id AND class_id=:class_id");
    $r = $q->execute([
        ":id" => $id,
        ":name" => $name,
        ":color" => strtolower($color->name),
        ":type" => strtolower($type->name),
        ":class_id" => $class_id
    ]);
    if (!$r) {
        return array("Erreur lors de la mise à jour de la matière.");
    }
    return array();
}
function delete_subject(mixed $id, $class_id): array
{
    $q = getDB()->prepare("DELETE FROM subjects WHERE id=:id AND class_id=:class_id");
    $r = $q->execute([
        ":id" => $id,
        ":class_id" => $class_id
    ]);
    if (!$r) {
        return array("Erreur lors de la suppression de la matière.");
    }
    return array();
}

function create_subject(mixed $name, mixed $color, mixed $type, $class_id): array
{
    $type = SubjectType::fromString($type);
    $color = SubjectColor::fromString($color);
    if ($type === null || $color === null) {
        return array("Type ou couleur invalide.");
    }
    if (strlen($name) > 16) {
        return array("Le nom de la matière ne doit pas dépasser 16 caractères.");
    }

    $q = getDB()->prepare("INSERT INTO subjects (name, color, type, class_id) VALUES (:name, :color, :type, :class_id)");
    $r = $q->execute([
        ":name" => $name,
        ":color" => strtolower($color->name),
        ":type" => strtolower($type->name),
        ":class_id" => $class_id
    ]);
    if (!$r) {
        return array("Erreur lors de l'ajout de la matière.");
    }
    return array();
}

function get_class_subjects($class_id){
    $q = getDB()->prepare("SELECT * FROM subjects WHERE class_id = :class_id ORDER BY type, name");
    $q->execute([
        'class_id' => $class_id
    ]);
    return $q->fetchAll();
}