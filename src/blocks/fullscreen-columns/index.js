import { MediaUpload, RichText, useBlockProps } from "@wordpress/block-editor";
import { registerBlockType } from "@wordpress/blocks";
import "./editor.scss";
import "./style.scss";

registerBlockType("de/fullscreen-columns", {
  title: "DE Fullscreen Columns",
  icon: "columns",
  category: "layout",
  attributes: {
    swapColumns: { type: "boolean", default: false },
    textContent: { type: "string", default: "Your text here..." },
    imageURL: { type: "string", default: "" },
    imageAlt: { type: "string", default: "" },
  },

  edit: ({ attributes, setAttributes, isSelected }) => {
    const { swapColumns, textContent, imageURL, imageAlt } = attributes;
    const blockProps = useBlockProps({
      className: `fullscreen-columns ${swapColumns ? "swap" : ""} ${
        isSelected ? "is-selected" : ""
      }`,
    });

    return (
      <div {...blockProps}>
        {/* Toolbar-style controls inside the block */}
        <div className="de-controls">
          <label>
            <input
              type="checkbox"
              checked={swapColumns}
              onChange={(e) => setAttributes({ swapColumns: e.target.checked })}
            />{" "}
            Swap Columns
          </label>
        </div>

        <div className="columns">
          {/* TEXT COLUMN */}
          <div className="column column-text editable-box">
            <RichText
              tagName="p"
              placeholder="Add your text…"
              value={textContent}
              onChange={(value) => setAttributes({ textContent: value })}
            />
          </div>

          {/* IMAGE COLUMN */}
          <div className="column column-image editable-box">
            {imageURL ? (
              <>
                <img src={imageURL} alt={imageAlt} />
                {isSelected && (
                  <button
                    className="remove-image"
                    onClick={() =>
                      setAttributes({ imageURL: "", imageAlt: "" })
                    }
                  >
                    Remove Image
                  </button>
                )}
              </>
            ) : (
              // Image picker
              <MediaUpload
                onSelect={(media) =>
                  setAttributes({
                    imageURL: media.url,
                    imageAlt: media.alt,
                  })
                }
                allowedTypes={["image"]}
                render={({ open }) => (
                  <button className="button button-primary" onClick={open}>
                    Select Image
                  </button>
                )}
              />
            )}
          </div>
        </div>
      </div>
    );
  },

  save: ({ attributes }) => {
    const { swapColumns, textContent, imageURL, imageAlt } = attributes;
    return (
      <div className={`fullscreen-columns ${swapColumns ? "swap" : ""}`}>
        <div className="columns">
          <div className="column column-text">
            <p>{textContent}</p>
          </div>
          <div className="column column-image">
            {imageURL && <img src={imageURL} alt={imageAlt} />}
          </div>
        </div>
      </div>
    );
  },
});
