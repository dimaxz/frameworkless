<?php

namespace Price\Models\Selfprice\Base;

use \Exception;
use \PDO;
use Price\Models\Selfprice\Selfprice as ChildSelfprice;
use Price\Models\Selfprice\SelfpriceQuery as ChildSelfpriceQuery;
use Price\Models\Selfprice\Map\SelfpriceTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'selfprice' table.
 *
 *
 *
 * @method     ChildSelfpriceQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildSelfpriceQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildSelfpriceQuery orderByDatecreate($order = Criteria::ASC) Order by the datecreate column
 * @method     ChildSelfpriceQuery orderByDesc($order = Criteria::ASC) Order by the desc column
 *
 * @method     ChildSelfpriceQuery groupById() Group by the id column
 * @method     ChildSelfpriceQuery groupByName() Group by the name column
 * @method     ChildSelfpriceQuery groupByDatecreate() Group by the datecreate column
 * @method     ChildSelfpriceQuery groupByDesc() Group by the desc column
 *
 * @method     ChildSelfpriceQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSelfpriceQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSelfpriceQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSelfprice findOne(ConnectionInterface $con = null) Return the first ChildSelfprice matching the query
 * @method     ChildSelfprice findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSelfprice matching the query, or a new ChildSelfprice object populated from the query conditions when no match is found
 *
 * @method     ChildSelfprice findOneById(int $id) Return the first ChildSelfprice filtered by the id column
 * @method     ChildSelfprice findOneByName(string $name) Return the first ChildSelfprice filtered by the name column
 * @method     ChildSelfprice findOneByDatecreate(string $datecreate) Return the first ChildSelfprice filtered by the datecreate column
 * @method     ChildSelfprice findOneByDesc(string $desc) Return the first ChildSelfprice filtered by the desc column *

 * @method     ChildSelfprice requirePk($key, ConnectionInterface $con = null) Return the ChildSelfprice by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSelfprice requireOne(ConnectionInterface $con = null) Return the first ChildSelfprice matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSelfprice requireOneById(int $id) Return the first ChildSelfprice filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSelfprice requireOneByName(string $name) Return the first ChildSelfprice filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSelfprice requireOneByDatecreate(string $datecreate) Return the first ChildSelfprice filtered by the datecreate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSelfprice requireOneByDesc(string $desc) Return the first ChildSelfprice filtered by the desc column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSelfprice[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSelfprice objects based on current ModelCriteria
 * @method     ChildSelfprice[]|ObjectCollection findById(int $id) Return ChildSelfprice objects filtered by the id column
 * @method     ChildSelfprice[]|ObjectCollection findByName(string $name) Return ChildSelfprice objects filtered by the name column
 * @method     ChildSelfprice[]|ObjectCollection findByDatecreate(string $datecreate) Return ChildSelfprice objects filtered by the datecreate column
 * @method     ChildSelfprice[]|ObjectCollection findByDesc(string $desc) Return ChildSelfprice objects filtered by the desc column
 * @method     ChildSelfprice[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SelfpriceQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Price\Models\Selfprice\Base\SelfpriceQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Price\\Models\\Selfprice\\Selfprice', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSelfpriceQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSelfpriceQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSelfpriceQuery) {
            return $criteria;
        }
        $query = new ChildSelfpriceQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildSelfprice|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SelfpriceTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SelfpriceTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSelfprice A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, datecreate, desc FROM selfprice WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildSelfprice $obj */
            $obj = new ChildSelfprice();
            $obj->hydrate($row);
            SelfpriceTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildSelfprice|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildSelfpriceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SelfpriceTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSelfpriceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SelfpriceTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSelfpriceQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(SelfpriceTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SelfpriceTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SelfpriceTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSelfpriceQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SelfpriceTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the datecreate column
     *
     * Example usage:
     * <code>
     * $query->filterByDatecreate('2011-03-14'); // WHERE datecreate = '2011-03-14'
     * $query->filterByDatecreate('now'); // WHERE datecreate = '2011-03-14'
     * $query->filterByDatecreate(array('max' => 'yesterday')); // WHERE datecreate > '2011-03-13'
     * </code>
     *
     * @param     mixed $datecreate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSelfpriceQuery The current query, for fluid interface
     */
    public function filterByDatecreate($datecreate = null, $comparison = null)
    {
        if (is_array($datecreate)) {
            $useMinMax = false;
            if (isset($datecreate['min'])) {
                $this->addUsingAlias(SelfpriceTableMap::COL_DATECREATE, $datecreate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($datecreate['max'])) {
                $this->addUsingAlias(SelfpriceTableMap::COL_DATECREATE, $datecreate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SelfpriceTableMap::COL_DATECREATE, $datecreate, $comparison);
    }

    /**
     * Filter the query on the desc column
     *
     * Example usage:
     * <code>
     * $query->filterByDesc('fooValue');   // WHERE desc = 'fooValue'
     * $query->filterByDesc('%fooValue%'); // WHERE desc LIKE '%fooValue%'
     * </code>
     *
     * @param     string $desc The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSelfpriceQuery The current query, for fluid interface
     */
    public function filterByDesc($desc = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($desc)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $desc)) {
                $desc = str_replace('*', '%', $desc);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SelfpriceTableMap::COL_DESC, $desc, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSelfprice $selfprice Object to remove from the list of results
     *
     * @return $this|ChildSelfpriceQuery The current query, for fluid interface
     */
    public function prune($selfprice = null)
    {
        if ($selfprice) {
            $this->addUsingAlias(SelfpriceTableMap::COL_ID, $selfprice->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the selfprice table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SelfpriceTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SelfpriceTableMap::clearInstancePool();
            SelfpriceTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SelfpriceTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SelfpriceTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SelfpriceTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SelfpriceTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SelfpriceQuery
