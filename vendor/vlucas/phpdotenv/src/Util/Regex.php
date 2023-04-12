<?php

declare(strict_types=1);

namespace Dotenv\Util;

use GrahamCampbell\ResultType\Error;
use GrahamCampbell\ResultType\Result;
use GrahamCampbell\ResultType\Success;
use function preg_last_error;
use function preg_last_error_msg;
use function preg_match;
use function preg_match_all;
use function preg_replace_callback;
use function preg_split;
use const PREG_NO_ERROR;

/**
 * @internal
 */
final class Regex
{
    /**
     * This class is a singleton.
     *
     * @codeCoverageIgnore
     *
     * @return void
     */
    private function __construct()
    {
        //
    }

    /**
     * Perform a preg match, wrapping up the result.
     *
     * @param string $pattern
     * @param string $subject
     *
     * @return Result<bool,string>
     */
    public static function matches(string $pattern, string $subject)
    {
        return self::pregAndWrap(static function (string $subject) use ($pattern) {
            return @preg_match($pattern, $subject) === 1;
        }, $subject);
    }

    /**
     * Perform a preg match all, wrapping up the result.
     *
     * @param string $pattern
     * @param string $subject
     *
     * @return Result<int,string>
     */
    public static function occurrences(string $pattern, string $subject)
    {
        return self::pregAndWrap(static function (string $subject) use ($pattern) {
            return (int) @preg_match_all($pattern, $subject);
        }, $subject);
    }

    /**
     * Perform a preg replace callback, wrapping up the result.
     *
     * @param string   $pattern
     * @param callable $callback
     * @param string   $subject
     * @param int|null $limit
     *
     * @return Result<string,string>
     */
    public static function replaceCallback(string $pattern, callable $callback, string $subject, int $limit = null)
    {
        return self::pregAndWrap(static function (string $subject) use ($pattern, $callback, $limit) {
            return (string) @preg_replace_callback($pattern, $callback, $subject, $limit ?? -1);
        }, $subject);
    }

    /**
     * Perform a preg split, wrapping up the result.
     *
     * @param string $pattern
     * @param string $subject
     *
     * @return Result<string[],string>
     */
    public static function split(string $pattern, string $subject)
    {
        return self::pregAndWrap(static function (string $subject) use ($pattern) {
            /** @var string[] */
            return (array) @preg_split($pattern, $subject);
        }, $subject);
    }

    /**
     * Perform a preg operation, wrapping up the result.
     *
     * @template V
     *
     * @param callable(string):V $operation
     * @param string             $subject
     *
     * @return Result<V,string>
     */
    private static function pregAndWrap(callable $operation, string $subject)
    {
        $result = $operation($subject);

        if (preg_last_error() !== PREG_NO_ERROR) {
            /** @var Result<V,string> */
            return Error::create(preg_last_error_msg());
        }

        /** @var Result<V,string> */
        return Success::create($result);
    }
}
