<?php

namespace App\Libraries;

use CodeIgniter\HTTP\Files\UploadedFile;

class FilmTools
{
    /**
     * Stores a poster image in the shared pictures directory and optionally removes the previous file.
     *
     * @param UploadedFile $posterImage The uploaded poster file from the request.
     * @param string|null $oldPosterImage The previous poster filename to remove before saving the new one.
     * @return string The filename that was stored on disk.
     */
    public function storePosterImage(UploadedFile $posterImage, ?string $oldPosterImage = null): string
    {
        if ($oldPosterImage) {
            $this->deletePosterImage($oldPosterImage);
        }

        $posterName = $posterImage->getClientName();
        $posterImage->move(ROOTPATH . 'csfd_pictures', $posterName, true);

        return $posterName;
    }

    /**
     * Deletes a poster image from the shared pictures directory when it exists.
     *
     * @param string|null $posterImage The poster filename to delete.
     * @return void
     */
    public function deletePosterImage(?string $posterImage): void
    {
        if ($posterImage && is_file(ROOTPATH . 'csfd_pictures/' . $posterImage)) {
            @unlink(ROOTPATH . 'csfd_pictures/' . $posterImage);
        }
    }

    /**
     * Loads cast members and their roles for a given film using joins.
     *
     * @param int $filmId The film identifier.
     * @return array<object> The cast rows with person and role data.
     */
    public function getFilmPeopleWithRoles(int $filmId): array
    {
        $db = \Config\Database::connect();
        $builder = $db->table('persons_has_films');
        $builder->select('persons.id, persons.first_name, persons.last_name, roles.id as role_id, roles.name as role_name')
                ->join('persons', 'persons.id = persons_has_films.persons_id')
                ->join('roles', 'roles.id = persons_has_films.roles_id')
                ->where('persons_has_films.films_id', $filmId);

        return $builder->get()->getResultObject();
    }

    /**
     * Counts how many cast records are linked to a given film.
     *
     * @param int $filmId The film identifier.
     * @return int The number of linked cast rows.
     */
    public function getFilmCastCount(int $filmId): int
    {
        $db = \Config\Database::connect();
        $castCountRow = $db->table('persons_has_films')
            ->selectCount('persons_id', 'cast_count')
            ->where('films_id', $filmId)
            ->get()
            ->getRow();

        return (int) ($castCountRow->cast_count ?? 0);
    }
}
