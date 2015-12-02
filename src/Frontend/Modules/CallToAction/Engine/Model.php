<?php

namespace Frontend\Modules\CallToAction\Engine;

use Frontend\Core\Engine\Model as FrontendModel;
use Frontend\Core\Engine\Navigation;

/**
 * In this file we store all generic functions that we will be using in the Call To Action module
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
             FROM call_to_action AS i
             INNER JOIN meta AS m ON i.meta_id = m.id
             WHERE m.url = ?',
            array((string) $URL)
        );

        // no results?
        if (empty($item)) {
            return array();
        }

        // create full url
        $item['full_url'] = Navigation::getURLForBlock('CallToAction', 'Detail') . '/' . $item['url'];

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
             FROM call_to_action AS i
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
        $detailUrl = Navigation::getURLForBlock('CallToAction', 'Detail');

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
             FROM call_to_action AS i
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
             FROM call_to_action AS i
             INNER JOIN meta AS m ON i.meta_id = m.id
             WHERE i.category_id = ? AND i.language = ?
             ORDER BY i.sequence ASC, i.id DESC LIMIT ?, ?',
            array($categoryId, FRONTEND_LANGUAGE, (int) $offset, (int) $limit));

        // no results?
        if (empty($items)) {
            return array();
        }

        // get detail action url
        $detailUrl = Navigation::getURLForBlock('CallToAction', 'Detail');

        // prepare items for search
        foreach ($items as &$item) {
            $item['full_url'] = $detailUrl . '/' . $item['url'];
        }

        // return
        return $items;
    }
    
    /**
     * Get all Side Block Widgets used 4
     *
     * @return array
     */
    public static function getAllSideBlockWidgets()
    {
        $return = (array) FrontendModel::get('database')->getRecords(
            'SELECT id, titel AS title, afbeelding as img, link as link, linktekst as linktext, text as content
             FROM call_to_action
             WHERE category_id = 4
             ORDER BY sequence ASC',
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
     * Get all Main Widgets used 3
     *
     * @return array
     */
    public static function getAllMainWidgets()
    {
        $return = (array) FrontendModel::get('database')->getRecords(
            'SELECT id, titel AS title, afbeelding as img, link as link, linktekst as linktext, text as content
             FROM call_to_action
             WHERE category_id = 3
             ORDER BY sequence ASC',
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
     * Get all Facebook Widgets used 1
     *
     * @return array
     */
    public static function getAllFacebookWidgets()
    {
        $return = (array) FrontendModel::get('database')->getRecords(
            'SELECT id, titel AS title, afbeelding as img, link as link, linktekst as linktext, text as content
             FROM call_to_action
             WHERE category_id = 1
             ORDER BY sequence ASC',
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
     * Get all Footer Widgets used 2
     *
     * @return array
     */
    public static function getAllFooterWidgets()
    {
        $return = (array) FrontendModel::get('database')->getRecords(
            'SELECT id, titel AS title, afbeelding as img, link as link, linktekst as linktext, text as content
             FROM call_to_action 
             WHERE category_id = 2
             ORDER BY sequence ASC LIMIT 3',
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
             FROM call_to_action_categories AS i
             INNER JOIN meta AS m ON i.meta_id = m.id
             WHERE m.url = ?',
            array((string) $URL)
        );

        // no results?
        if (empty($item)) {
            return array();
        }

        // create full url
        $item['full_url'] = Navigation::getURLForBlock('CallToAction', 'category') . '/' . $item['url'];

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
             FROM call_to_action AS i
             WHERE i.language = ? AND i.category_id = ?',
            array(FRONTEND_LANGUAGE, (int) $categoryId)
        );
    }

}
