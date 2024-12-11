<?php
/*
Plugin Name: Quote of the Day
Description: Toont een willekeurige inspirerende quote elke dag
Version: 1.0
Author: Youri
*/

// Voorkom directe toegang tot het plugin-bestand
if (!defined('ABSPATH')) {
    exit;
}

class QuoteOfTheDay {
    private $quotes = [
        [
            'quote' => 'Succes is niet definitief, falen is niet fataal: het is de moed om door te gaan die telt.',
            'author' => 'Winston Churchill'
        ],
        [
            'quote' => 'Geloof in jezelf en alles wat je kunt bereiken.',
            'author' => 'Ralph Waldo Emerson'
        ],
        [
            'quote' => 'Elke dag is een nieuwe kans om je dromen waar te maken.',
            'author' => 'Onbekend'
        ],
        [
            'quote' => 'De toekomst behoort toe aan degenen die geloven in de schoonheid van hun dromen.',
            'author' => 'Eleanor Roosevelt'
        ],
        [
            'quote' => 'Je kunt de golven niet tegenhouden, maar je kunt wel leren surfen.',
            'author' => 'Jon Kabat-Zinn'
        ]
    ];

    public function __construct() {
        // Registreer shortcode
        add_shortcode('quote_of_the_day', [$this, 'render_quote']);
        
        // Voeg CSS toe
        add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);
    }

    public function get_random_quote() {
        // Selecteer een willekeurige quote
        return $this->quotes[array_rand($this->quotes)];
    }

    public function render_quote() {
        // Haal willekeurige quote op
        $quote_data = $this->get_random_quote();
        
        // Genereer HTML voor quote
        $output = sprintf(
            '<div class="quote-of-the-day">
                <blockquote>"%s"</blockquote>
                <cite>- %s</cite>
            </div>',
            esc_html($quote_data['quote']),
            esc_html($quote_data['author'])
        );
        
        return $output;
    }

    public function enqueue_styles() {
        // Voeg inline CSS toe
        wp_register_style('quote-of-the-day-style', false);
        wp_enqueue_style('quote-of-the-day-style');
        
        $custom_css = '
        .quote-of-the-day {
            background-color: #f9f9f9;
            border-left: 5px solid #3498db;
            padding: 15px;
            margin: 20px 0;
            font-style: italic;
            max-width: 600px;
        }
        .quote-of-the-day blockquote {
            margin: 0 0 10px 0;
            font-size: 1.2em;
        }
        .quote-of-the-day cite {
            display: block;
            text-align: right;
            color: #666;
        }
        ';
        
        wp_add_inline_style('quote-of-the-day-style', $custom_css);
    }
}

// Initialiseer de plugin
new QuoteOfTheDay();