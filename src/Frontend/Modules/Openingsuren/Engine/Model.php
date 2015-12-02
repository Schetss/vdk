<?php

namespace Frontend\Modules\Openingsuren\Engine;

use Frontend\Core\Engine\Model as FrontendModel;
use Frontend\Core\Engine\Navigation;

/**
 * In this file we store all generic functions that we will be using in the Openingsuren module
 *
 * @author Stijn Schets <stijn@schetss.be>
 */
class Model
{
    /**
     * Fetches a certain item
     *
     * @param string $URL
     * @return array
     */
    public static function get($URL)
    {
        $item = (array) FrontendModel::get('database')->getRecord(
            'SELECT i.*,
             m.keywords AS meta_keywords, m.keywords_overwrite AS meta_keywords_overwrite,
             m.description AS meta_description, m.description_overwrite AS meta_description_overwrite,
             m.title AS meta_title, m.title_overwrite AS meta_title_overwrite, m.url
             FROM openingsuren AS i
             INNER JOIN meta AS m ON i.meta_id = m.id
             WHERE m.url = ?',
            array((string) $URL)
        );

        // no results?
        if (empty($item)) {
            return array();
        }

        // create full url
        $item['full_url'] = Navigation::getURLForBlock('Openingsuren', 'Detail') . '/' . $item['url'];

        return $item;
    }

    /**
     * Get all items (at least a chunk)
     *
     * @param int $limit The number of items to get.
     * @param int $offset The offset.
     * @return array
     */
    public static function getAll($limit = 10, $offset = 0)
    {
        $items = (array) FrontendModel::get('database')->getRecords(
            'SELECT i.*, m.url
             FROM openingsuren AS i
             INNER JOIN meta AS m ON i.meta_id = m.id
             WHERE i.language = ?
             ORDER BY i.sequence ASC, i.id DESC LIMIT ?, ?',
            array(FRONTEND_LANGUAGE, (int) $offset, (int) $limit)
        );

        // no results?
        if (empty($items)) {
            return array();
        }

        // get detail action url
        $detailUrl = Navigation::getURLForBlock('Openingsuren', 'Detail');

        // prepare items for search
        foreach ($items as &$item) {
            $item['full_url'] =  $detailUrl . '/' . $item['url'];
        }

        // return
        return $items;
    }

    /**
     * Get the number of items
     *
     * @return int
     */
    public static function getAllCount()
    {
        return (int) FrontendModel::get('database')->getVar(
            'SELECT COUNT(i.id) AS count
             FROM openingsuren AS i
             WHERE i.language = ?',
            array(FRONTEND_LANGUAGE)
        );
    }

    /**
     * Get all category items (at least a chunk)
     *
     * @param int $categoryId
     * @param int $limit The number of items to get.
     * @param int $offset The offset.
     * @return array
     */
    public static function getAllByCategory($categoryId, $limit = 10, $offset = 0)
    {
        $items = (array) FrontendModel::get('database')->getRecords(
            'SELECT i.*, m.url
             FROM openingsuren AS i
             INNER JOIN meta AS m ON i.meta_id = m.id
             WHERE i.category_id = ? AND i.language = ?
             ORDER BY i.sequence ASC, i.id DESC LIMIT ?, ?',
            array($categoryId, FRONTEND_LANGUAGE, (int) $offset, (int) $limit));

        // no results?
        if (empty($items)) {
            return array();
        }

        // get detail action url
        $detailUrl = Navigation::getURLForBlock('Openingsuren', 'Detail');

        // prepare items for search
        foreach ($items as &$item) {
            $item['full_url'] = $detailUrl . '/' . $item['url'];
        }

        // return
        return $items;
    }
    /**
     * Get all categories used
     *
     * @return array
     */
    public static function getAllCategories()
    {
        $return = (array) FrontendModel::get('database')->getRecords(
            'SELECT c.id, c.title AS label, m.url, COUNT(c.id) AS total, m.data AS meta_data
             FROM openingsuren_categories AS c
             INNER JOIN openingsuren AS i ON c.id = i.category_id AND c.language = i.language
             INNER JOIN meta AS m ON c.meta_id = m.id
             GROUP BY c.id
             ORDER BY c.sequence ASC',
            array(),
            'id'
        );

        // loop items and unserialize
        foreach ($return as &$row) {
            if (isset($row['meta_data'])) {
                $row['meta_data'] = unserialize($row['meta_data']);
            }
        }

        return $return;
    }


     /**
     * Get all open
     *
     * @return array
     */
    public static function getAllOpen()
    {
        $return = (array) FrontendModel::get('database')->getRecords(
            "SELECT naam as name FROM openingsuren WHERE 
            (wij_zijn_op_vakantie = 'N') 
            AND (sluitingsdagen LIKE CONCAT('%',DAY(CURRENT_DATE), '/', MONTH(CURRENT_DATE),'%') = 0)
            AND
            (
            (
                DATE_ADD(CURTIME(),  INTERVAL 1 HOUR)  BETWEEN maandagvoormiddag_open AND maandagvoormiddag_sluit
                AND DAYNAME(CURRENT_DATE) = 'MONDAY'
                AND maandag_open = 'Y'
            )
            OR 
            (
                DATE_ADD(CURTIME(),  INTERVAL 1 HOUR) BETWEEN maandagnamiddag_open AND maandagnamiddag_sluit
                AND DAYNAME(CURRENT_DATE) = 'MONDAY'
                AND maandag_open = 'Y'
            )
            OR 
            (
                DATE_ADD(CURTIME(),  INTERVAL 1 HOUR) BETWEEN dinsdagvoormiddag_open AND dinsdagvoormiddag_sluit
                AND DAYNAME(CURRENT_DATE) = 'TUESDAY'
                AND dinsdag_open = 'Y'
            )
            OR 
            (
                DATE_ADD(CURTIME(),  INTERVAL 1 HOUR) BETWEEN dinsdagnamiddag_open AND dinsdagnamiddag_sluit
                AND DAYNAME(CURRENT_DATE) = 'TUESDAY'
                AND dinsdag_open = 'Y'
            )
            OR 
            (
                DATE_ADD(CURTIME(),  INTERVAL 1 HOUR) BETWEEN woensdagvoormiddag_open AND woensdagvoormiddag_sluit
                AND DAYNAME(CURRENT_DATE) = 'WEDNESDAY'
                AND woensdag_open = 'Y'
            )
            OR 
            (
                DATE_ADD(CURTIME(),  INTERVAL 1 HOUR) BETWEEN woensdagnamiddag_open AND woensdagnamiddag_sluit
                AND DAYNAME(CURRENT_DATE) = 'WEDNESDAY'
                AND woensdag_open = 'Y'
            )
            OR 
            (
                DATE_ADD(CURTIME(),  INTERVAL 1 HOUR) BETWEEN donderdagvoormiddag_open AND donderdagvoormiddag_sluit
                AND DAYNAME(CURRENT_DATE) = 'THURSDAY'
                AND donderdag_open = 'Y'
            )
            OR 
            (
                DATE_ADD(CURTIME(),  INTERVAL 1 HOUR)  BETWEEN donderdagnamiddag_open AND donderdagnamiddag_sluit
                AND DAYNAME(CURRENT_DATE) = 'THURSDAY'
                AND donderdag_open = 'Y'
            )
            OR 
            (
                DATE_ADD(CURTIME(),  INTERVAL 1 HOUR) BETWEEN vrijdagvoormiddag_open AND vrijdagvoormiddag_sluit
                AND DAYNAME(CURRENT_DATE) = 'FRIDAY'
                AND vrijdag_open = 'Y'
            )
            OR 
            (
                DATE_ADD(CURTIME(),  INTERVAL 1 HOUR) BETWEEN vrijdagnamiddag_open AND vrijdagnamiddag_sluit
                AND DAYNAME(CURRENT_DATE) = 'FRIDAY'
                AND vrijdag_open = 'Y'
            )
            OR 
            (
                DATE_ADD(CURTIME(),  INTERVAL 1 HOUR) BETWEEN zaterdagvoormiddag_open AND zaterdagvoormiddag_sluit
                AND DAYNAME(CURRENT_DATE) = 'SATERDAY'
                AND zaterdag_open = 'Y'
            )
            OR 
            (
                DATE_ADD(CURTIME(),  INTERVAL 1 HOUR) BETWEEN zaterdagnamiddag_open AND zaterdagnamiddag_sluit
                AND DAYNAME(CURRENT_DATE) = 'SATERDAY'
                AND zaterdag_open = 'Y'
            )
            OR 
            (
                DATE_ADD(CURTIME(),  INTERVAL 1 HOUR) BETWEEN zondagvoormiddag_open AND zondagvoormiddag_sluit
                AND DAYNAME(CURRENT_DATE) = 'SUNDAY'
                AND zondag_open = 'Y'
            )
            OR 
            (
                DATE_ADD(CURTIME(),  INTERVAL 1 HOUR) BETWEEN zondagnamiddag_open AND zondagnamiddag_sluit
                AND DAYNAME(CURRENT_DATE) = 'SUNDAY'
                AND zondag_open = 'Y'
            )
            )
            ");

        return $return;
    }

    /**
     * Fetches a certain category
     *
     * @param string $URL
     * @return array
     */
    public static function getCategory($URL)
    {
        $item = (array) FrontendModel::get('database')->getRecord(
            'SELECT i.*,
             m.keywords AS meta_keywords, m.keywords_overwrite AS meta_keywords_overwrite,
             m.description AS meta_description, m.description_overwrite AS meta_description_overwrite,
             m.title AS meta_title, m.title_overwrite AS meta_title_overwrite, m.url
             FROM openingsuren_categories AS i
             INNER JOIN meta AS m ON i.meta_id = m.id
             WHERE m.url = ?',
            array((string) $URL)
        );

        // no results?
        if (empty($item)) {
            return array();
        }

        // create full url
        $item['full_url'] = Navigation::getURLForBlock('Openingsuren', 'category') . '/' . $item['url'];

        return $item;
    }



    /**
     * Get the number of items in a category
     *
     * @param int $categoryId
     * @return int
     */
    public static function getCategoryCount($categoryId)
    {
        return (int) FrontendModel::get('database')->getVar(
            'SELECT COUNT(i.id)
             FROM openingsuren AS i
             WHERE i.language = ? AND i.category_id = ?',
            array(FRONTEND_LANGUAGE, (int) $categoryId)
        );
    }

}
