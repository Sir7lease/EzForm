<?php
namespace EzForm;

/**
 * This Class allows you to add fields (input, select...) in you form
 *
 * @author  Hammoumi Abdelaziz
 */
class InputTag extends FieldAttributes implements FieldInterface
{
    private static int $index = 0;

    /** @var string[] $attributes contains all the attributes that will be added in the form tag */
    public array $attributes = [];

    public function __construct(string $type='text', string $name='field_')
    {
        $this->attributes = [
            'type' => $type,
            'name' => $name . self::$index++,
        ];
    }






    /* Make that into array and use in_array to check if the type is correct
     * <input type='button">
    <input type="checkbox">
    <input type="color">
    <input type="date">
    <input type="datetime-local">
    <input type="email">
    <input type="file">
    <input type="hidden">
    <input type="image">
    <input type="month">
    <input type="number">
    <input type="password">
    <input type="radio">
    <input type="range">
    <input type="reset">
    <input type="search">
    <input type="submit">
    <input type="tel">
    <input type="text"> (default value)
    <input type="time">
    <input type="url">
    <input type="week">*/




}